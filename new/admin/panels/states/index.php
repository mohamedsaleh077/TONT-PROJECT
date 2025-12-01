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
                <h2>states table</h2>
                <div class="table-controls">
                    <form action="./includes/create.php" method="post">
                        <input type="hidden" name="token" value="<?= $_SESSION['CSRF_TOKEN']; ?>">
                        <input type="text" name="name" placeholder="Enter state name">
                        <button type="submit">Add State</button>
                    </form>
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="error-message" style="display: block;">
                            <?php $session->print_saved_errors(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <span id="statues"></span>
                <span id="pages"></span>
                <table id="dataTable">
                    <thead>
                    <tr>
                        <th><div class="tables-div">id</div></th>
                        <th><div class="tables-div">state</div></th>
                        <th><div class="tables-div">updated at</div></th>
                        <th><div class="tables-div">created at</div></th>
                        <th><div class="tables-div">action</div></th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>

                <div class="pagination">
                    search: <input type="text" id="keyword" placeholder="Search"> <button onclick="search()">🔍</button> <button id="cancel" style="display: none" onclick="gobackagain()"><i class="fa-solid fa-delete-left"></i></button> &nbsp; total: <span id="total"></span>
                </div>
                <div class="operations">
                    double click on state name to edit then the pen icon to save changes
                </div>
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