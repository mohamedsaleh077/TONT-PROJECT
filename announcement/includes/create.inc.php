<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/DataValidation.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/SessionManager.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/announcement/PostsHandler/Posts.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/UploadFile.php";

use oop\DataValidation;
use oop\SessionManager;
use PostsHandler\Posts;
use oop\UploadFile;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.php');
    die();
}

$session = new SessionManager();
$session->start_session();

if ($_POST === []){
    header('Location: ../index.php');
    $_SESSION['errors'] = ["حدث خطأ في الاتصال أو المرفقات"];
    die();
}

$error = new DataValidation();

if (!isset($_SESSION['user_id']) && $_SESSION['role_name'] != 'teacher' && !isset($_SESSION['school_id'])) {
    header('Location: /login/index.php');
    die();
}

$token = $_POST['token'] ?? '';
$subject = $_POST['subject'] ?? '';
$body = $_POST['body'] ?? '';
$media = null;

$error->is_empty([$token, $subject]);
$error->valid_CSRF($token);
$error->max255($subject);
$error->valid_length($body, 1000);

if ($error->getErrors()) {
    $_SESSION['errors'] = $error->getErrors();
    header('Location: ../index.php');
    die();
}

if ((isset($_FILES['media']) && $_FILES['media']['error'] !== UPLOAD_ERR_NO_FILE)) {
    $error_code = $_FILES['media']['error'];
    switch ($error_code) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $error->addError("حجم الملف المرفوع كبير جداً. الحد الأقصى المسموح به هو X ميغابايت.");
            break;
        case UPLOAD_ERR_PARTIAL:
            $error->addError("تم رفع جزء فقط من الملف. يرجى المحاولة مرة أخرى.");
            break;
        default:
            $error->addError("حدث خطأ غير متوقع أثناء عملية الرفع.");
            break;
    }

    if (!$error->getErrors()) {
        try {
            // Instantiate and process the upload
            $upload = new UploadFile($_FILES['media']);
            // Assuming upload() returns an object/stdClass with 'ok', 'filename', 'error'
            $upload_report = $upload->upload();
//            var_dump($upload_report);;
            // Check custom validation/move errors from the UploadFile class
            if ($upload_report['ok'] === 0) {
                $_SESSION['errors'] = $upload_report['error'];
                header('Location: ../index.php');
                die();
            } else {
                $media = $upload_report['filename'];
            }
        } catch (\Exception $e) {
            error_log("Upload File Error: " . $e->getMessage());
            $error->addError("فشل تحميل الملف بسبب خطأ داخلي.");
        }
    }
}

if ($error->getErrors()) {
    $_SESSION['errors'] = $error->getErrors();
    header('Location: ../index.php');
    die();
}

$school_id = $_SESSION['school_id'];
$user_id = $_SESSION['user_id'];

$posts = new Posts($school_id);

try {
    $posts->creat_post($user_id, $school_id, $subject, $body, $media);
} catch (\Exception $e) {
    error_log("Post creation DB failed: " . $e->getMessage());
    $_SESSION['errors'] = ["حدث خطأ في قاعدة البيانات. لم يتم إنشاء المنشور."];
    header('Location: ../index.php');
    die();
}

header('Location: ../index.php');
die();