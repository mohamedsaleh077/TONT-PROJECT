<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use oop\SessionManager;
use oop\Admin\State;

require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/SessionManager.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Admin/State.php";

$session = new SessionManager();
$session->start_session();

$states_list = new State();
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
//$browser = get_browser(null, true);

if ($_SESSION['role_name'] === 'sudo') {
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>اللوحة الادارية - المحافظات</title>
        <!--        <link rel="stylesheet" href="/assets/styles/login/main.css">-->
        <link rel="stylesheet" href="../main.css">
    </head>

    <body style="display: block;">
    <div class="wrapper">

        <header>
            <h1>Tont-MyAdmin</h1>
            <div class="right">
                <a href="#">Log out</a> | <a href="#">settings</a>
            </div>
        </header>

        <div class="status-bar">
            <?= $_SESSION['admin_name']; ?> is logged in as <?= $_SESSION['role_name']; ?>
            at <?= $_SESSION['login_time']; ?> – ip:<?= $_SERVER['REMOTE_ADDR']; ?> – <?= $_SERVER['HTTP_USER_AGENT'] ?>
        </div>

        <!--        <div class="navbar">-->
        <!--            <a href="#">create</a>-->
        <!--            <a href="#">view</a>-->
        <!--            <a href="#">edit</a>-->
        <!--            <a href="#">export</a>-->
        <!--            <a href="#">import</a>-->
        <!--        </div>-->

        <div class="main">
            <!--            <div class="left-panel">-->
            <!--                <h3>info</h3>-->
            <!--                <p>blah blah blah blah blah<br>blah blah blah blah blah</p>-->
            <!---->
            <!--                <h3>things</h3>-->
            <!--                <ol>-->
            <!--                    <li>blah blah blah</li>-->
            <!--                    <li>blah blah blah</li>-->
            <!--                    <li>blah blah blah</li>-->
            <!--                </ol>-->
            <!---->
            <!--                <h3>database</h3>-->
            <!--                <p>MySQL 5.0.67<br>localhost:3306</p>-->
            <!--            </div>-->

            <div class="center">
                <h2>General Operations</h2>
                <ul>
                    <li><a href="./includes/del_states.php">Delete All States.</a></li>
                    <li><a href="./includes/del_schools.php">Delete All Schools.</a></li>
                </ul>

                the rest is coming soon :P
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="error-message" style="display: block;">
                        <?php $session->print_saved_errors(); ?>
                    </div>
                <?php endif; ?>

            </div>

            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/new/admin/sidebar.php'; ?>
        </div>

        <footer>
            &copy; 2026 Tont-MyAdmin
        </footer>

    </div>
    <script src="pagination.js"></script>
    </body>
    </html>
    <?php
} else {
    header("Location: /index.php");
}
?>