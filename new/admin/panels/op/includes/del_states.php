<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/State.php';

use oop\DataValidation;
use oop\Admin\State;
use oop\SessionManager;

$session = new SessionManager();
$session->start_session();

$state = new State();

if ($_SESSION['role_name'] !== 'sudo') {
    header("Location: /index.php");
}

if ($state->delete_all()){
    $_SESSION['errors'] = ['all states deleted successfully'];
    header("Location: /new/admin/panels/op/index.php");
} else {
    $_SESSION['errors'] = ['error deleting states'];
}

exit();