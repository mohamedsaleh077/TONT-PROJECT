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

if ($_SESSION['role_name'] !== 'sudo' || !isset($_GET['id'])) {
    header("Location: /index.php");
    die();
}

$id = $_GET['id'];
if ($state->delete($id)){
    $_SESSION['errors'] = ['state with id: ' . $id . ' deleted successfully'];
    header("Location: /new/admin/panels/states/index.php");
    die();
} else {
    $_SESSION['errors'] = ['state with id: ' . $id . ' not deleted, Error'];
}

exit();