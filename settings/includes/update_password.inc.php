<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config_session.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Dbh.php';

use oop\DataValidation;
use oop\Dbh;

if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: /index.php');
    die();
}
if (!isset($_POST['old'], $_POST['token'], $_POST['new'], $_POST['confirm'])) {
    header('Location: /index.php');
    die();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /login/index.php');
    die();
}

$old = $_POST['old'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];
$token = $_POST['token'];
$user_id = $_SESSION['user_id'];

$error = new DataValidation();

$error->is_empty([$old, $new, $confirm ,$token]);
$error->valid_CSRF($token);
$error->max255($old);
$error->max255($confirm);
$error->max255($new);

if ($new != $confirm) {
    $error->addError("تأكيد كلمة المرور التأكيدية لا تطابق الجديدة");
}

$dbh = new Dbh();
$pdo = $dbh->connect();

$stmt = $pdo->prepare("SELECT pwd FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$error->check_password($old, $user['pwd']);

if ($error->getErrors()) {
    $_SESSION['errors'] = $error->getErrors();
    header("Location: /settings/index.php");
    die();
}

$options = [
    'cost' => 12
];
$newHashedPassword = password_hash($new, PASSWORD_DEFAULT, $options);

$stmt = $pdo->prepare("UPDATE users SET pwd = :pwd WHERE id = :user_id");
$stmt->bindParam(':pwd', $newHashedPassword, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

try {
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

header("Location: /settings/index.php?pwd=done");
die();