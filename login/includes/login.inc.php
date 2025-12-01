<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/input_validation.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["loginEmail"];
    $pwd = $_POST["loginPassword"];

    $csrf_token_arrival = isset($_POST['token']);

    if ($csrf_token_arrival) {
        $csrf_token = $_POST['token'];
    } else {
        header("Location: ../index.php");
        die();
    }

    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";
        require_once "login_model.inc.php";
        require_once "login_control.inc.php";

        $errors = [];

        // Error Handlers
        if (!is_CSRF_invalid($csrf_token)) {
            if (isInputEmpty($email, $pwd)) {
                $errors["EmptyInput"] = "Fill in all fields!";
            } else {
                $results = getUser($pdo, $email);
                if (isUsernameWrong($results)) {
                    $errors["usernameNotFound"] = "E-mail Doesnt Exists!";
                } else {
                    if (isPasswordWrong($pwd, $results['pwd'])) {
                        $errors["passwdWrong"] = "password wrong!";
                    }
                }
            }
        } else {
            $errors["csrf"] = "something went wrong! try to refresh the page and try again";
        }

        if ($errors) {
            $_SESSION["ErrorLogin"] = $errors;

            header("Location: ../index.php");
            $pdo = null;
            $stmt = null;

            die();
        } else {
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . '_' . $results['id'];
            session_id($sessionId);

            $_SESSION['user_id'] = $results['id'];
            $_SESSION['pfp'] = $results['profile_picture'] ?? 'default.jpg';
            $_SESSION['fullname'] = $results['name'];
            $_SESSION['user_role'] = $results['role'];
            $_SESSION['ref_id'] = $results['ref_id'];
            $_SESSION['school_name'] = $results['school_name'];
            $_SESSION['school_id'] = $results['school_id'];
            $_SESSION['subject'] = $results['subject'];
            $_SESSION['code'] = $results['ref_id'];
            $_SESSION['grade'] = $results['student_grade'];
            $_SESSION['subject'] = $results['teacher_subject'];
            $_SESSION['email'] = $results['email'];
            $_SESSION['bio'] = $results['bio'];
            $_SESSION['2fa_secret'] = $results['2fa_secret'];
            $_SESSION['2fa_is_active'] = $results['2fa_is_active'];
            $_SESSION['last_regeneration'] = time();

            header("Location: /apps/dashboard/index.php");

            $pdo = null;
            $stmt = null;
            die();
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
