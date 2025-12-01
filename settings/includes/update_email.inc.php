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
if (!isset($_POST['email'], $_POST['token'])) {
    header('Location: /index.php');
    die();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /login/index.php');
    die();
}

$newMail = $_POST['email'];
$token = $_POST['token'];
$user_id = $_SESSION['user_id'];

$error = new DataValidation();

$error->is_empty([$newMail, $token]);
$error->valid_CSRF($token);
$error->max255($newMail);
$error->valid_email($newMail);

if ($error->getErrors()) {
    $_SESSION['errors'] = $error->getErrors();
    header("Location: /settings/index.php");
    die();
}

$dbh = new Dbh();
$pdo = $dbh->connect();

$stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = :user_id");
$stmt->bindParam(':email', $newMail, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
try {
    $stmt->execute();
    $_SESSION['email'] = $newMail;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

header("Location: /settings/index.php?email=done");
die();