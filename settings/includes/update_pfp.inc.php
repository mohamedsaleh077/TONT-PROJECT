<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config_session.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Dbh.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/UploadFile.php';

use oop\DataValidation;
use oop\Dbh;
use oop\UploadFile;

if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: /index.php');
    die();
}
if (!isset($_POST['mode'], $_POST['token'])) {
    header('Location: /index.php');
    die();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /login/index.php');
    die();
}

$mode = $_POST['mode'];
$token = $_POST['token'];
$user_id = $_SESSION['user_id'];

$error = new DataValidation();

$error->is_empty([$mode, $token]);
$error->valid_CSRF($token);

if ($mode == 'keep') {
    header("Location: /settings/index.php");
    die();
}

if ($mode == 'change') {
    if ((isset($_FILES['pfp']) && $_FILES['media']['error'] === UPLOAD_ERR_NO_FILE)) {
        $error->addError("لم يتم رفع اي ملفات");
    }

    $error_code = $_FILES['media']['error'];
    switch ($error_code) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $error->addError("حجم الملف المرفوع كبير جداً. الحد الأقصى المسموح به هو 10 ميغابايت.");
            break;
        case UPLOAD_ERR_PARTIAL:
            $error->addError("تم رفع جزء فقط من الملف. يرجى المحاولة مرة أخرى.");
            break;
        default:
            $error->addError("حدث خطأ غير متوقع أثناء عملية الرفع.");
            break;
    }

    try {
        $upload = new UploadFile($_FILES['pfp'], 'pfp_', '/settings/pfps/');
        $upload_report = $upload->upload();
        if ($upload_report['ok'] === 0) {
            $error->addErrors($upload_report['error']);
        } else {
            $media = $upload_report['filename'];
            if ($_SESSION['pfp'] !== 'default.jpg') {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/settings/pfps/' . $_SESSION['pfp']);
            }
        }
    } catch (\Exception $e) {
        $error->addError("فشل تحميل الملف بسبب خطأ داخلي." . $e->getMessage());
    }
}

if ($mode == 'delete') {
    $media = 'default.jpg';
    unlink($_SERVER['DOCUMENT_ROOT'] . '/settings/pfps/' . $_SESSION['pfp']);
}

if ($error->getErrors()) {
    $_SESSION['errors'] = $error->getErrors();
    header("Location: /settings/index.php");
    die();
}

$dbh = new Dbh();
$pdo = $dbh->connect();

$stmt = $pdo->prepare("UPDATE users SET profile_picture = :pfp WHERE id = :user_id");
$stmt->bindParam(':pfp', $media, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

try {
    $stmt->execute();
    $_SESSION['pfp'] = $media;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

header("Location: /settings/index.php?pfp=done");
die();