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
if ($school->delete($id)){
    $_SESSION['errors'] = ['school with id: ' . $id . ' deleted successfully'];
    header("Location: /new/admin/panels/school/index.php");
    die();
} else {
    $_SESSION['errors'] = ['school with id: ' . $id . ' not deleted, Error'];
    header("Location: /new/admin/panels/school/index.php");
}

exit();