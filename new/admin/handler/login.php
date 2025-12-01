<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../oop/DataValidation.php';
require_once '../../oop/Admin/Login.php';

use oop\Admin\Login;
use oop\DataValidation;
use oop\Dbh;

if (isset($_SERVER['REQUEST_METHOD']) &&
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['username']) &&
    isset($_POST['pwd']) &&
    isset($_POST['token'])
){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    $login = new Login($username, $pwd);

    $errors = new DataValidation();
    $errors->max255($username);
    $errors->max255($pwd);
    $errors->is_empty([$username, $pwd]);
    $errors->valid_CSRF($_POST['token']);
    $errors->check_existance($username);

    if ($errors->getErrors()){
        $_SESSION['errors'] = $errors->getErrors();
        header("Location: /new/admin/login.php");
        die();
    } else {
        $user = $login->get_user();
        if ($errors->check_password($pwd, $user['pwd'])){
            if($login->setup_session($user)){
                header("Location: /new/admin/panel.php");
                die();
            } else {
                $_SESSION['errors'] = ['password is incorrect'];
                header("Location: /new/admin/login.php");
                die();
            }
        } else {
            $_SESSION['errors'] = $errors->getErrors();
            header("Location: /new/admin/login.php");
            die();
        }
    }


} else {
    header("Location: /index.php");
    die();
}