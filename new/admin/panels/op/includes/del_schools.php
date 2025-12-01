<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/School.php';

use oop\Admin\School;
use oop\SessionManager;

$session = new SessionManager();
$session->start_session();

$schools = new School();

if ($_SESSION['role_name'] !== 'sudo') {
    header("Location: /index.php");
}

if ($schools->delete_all()){
    $_SESSION['errors'] = ['all states deleted successfully'];
    header("Location: /new/admin/panels/op/index.php");
} else {
    $_SESSION['errors'] = ['error deleting states'];
}

exit();