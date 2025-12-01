<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/State.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/School.php';

use oop\DataValidation;
use oop\Admin\State;
use oop\SessionManager;
use oop\Admin\School;

$session = new SessionManager();
$state = new State();
$errors = new DataValidation();
$school = new School();

$session->start_session();

if ($_SESSION['role_name'] === 'sudo' &&
    isset($_SERVER['REQUEST_METHOD']) &&
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['name']) &&
    isset($_POST['token']) &&
    isset($_POST['state_id'])
) {
    $name = $_POST['name'];
    $state_id = $_POST['state_id'];
    $token = $_POST['token'];

    $errors->is_empty([$name, $state_id]);
    $errors->max255($name);
    $errors->valid_CSRF($token);

    if (is_numeric($state_id) &&
        ($state_id > 0 && $state_id < 1000000000)){
        $state_id = (int)$state_id;
    } else {
        $errors->addError("school id is invalid");
    }

    if (!$state->state_exists_by_id($state_id)) {
        $errors->addError("school does not exist");
    }

    if ($errors->getErrors()) {
        $_SESSION['errors'] = $errors->getErrors();
        header("Location: /new/admin/panels/school/index.php");
        die();
    } else {
        if ($school->school_exists($name, $state_id)) {
            $_SESSION['errors'] = ['school already exists'];
            header("Location: /new/admin/panels/school/index.php");
            die();
        } else {
            $school->create_school($name, $state_id);
            $_SESSION['errors'] = [$name . ' school created successfully'];
            header("Location: /new/admin/panels/school/index.php");
            die();
        }
    }

} else {
    header("Location: /index.php");
    die();
}