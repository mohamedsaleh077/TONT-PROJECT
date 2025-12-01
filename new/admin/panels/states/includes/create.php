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

if ($_SESSION['role_name'] === 'sudo' &&
    isset($_SERVER['REQUEST_METHOD']) &&
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['name']) &&
    isset($_POST['token'])
) {
    $name = $_POST['name'];

    $create = new State();

    $errors = new DataValidation();
    $errors->is_empty([$name]);
    $errors->max255($name);
    $errors->valid_CSRF($_POST['token']);

    if ($errors->getErrors()) {
        $_SESSION['errors'] = $errors->getErrors();
        header("Location: /new/admin/panels/states/index.php");
        die();
    } else {
        if ($create->state_exists($name)) {
            $_SESSION['errors'] = ['state already exists'];
            header("Location: /new/admin/panels/states/index.php");
            die();
        } else {
            $create->create_state($name);
            $_SESSION['errors'] = [$name . ' state created successfully'];
            header("Location: /new/admin/panels/states/index.php");
            die();
        }
    }

} else {
    header("Location: /index.php");
    die();
}