<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/School.php';

use oop\SessionManager;
use oop\Admin\School;


$session = new SessionManager();
$session->start_session();

$school = new School();

if ($_SESSION['role_name'] !== 'sudo' || !isset($_GET['id'])) {
    header("Location: /index.php");
    die();
}

$id = $_GET['id'];
$newName = $_GET['name'];

if ($school->edit($id, $newName)){
    echo 'state with id: ' . $id . ' edited successfully';
} else {
    echo 'state with id: ' . $id . ' not edited, Error';
}

exit();