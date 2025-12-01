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
        <title>اللوحة الادارية - المدارس</title>
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
        <div class="main">
            <div class="center">
                <h2>Schools table</h2>
                <div class="table-controls">
                    <form action="./includes/create.php" method="post">
                        <input type="hidden" name="token" value="<?= $_SESSION['CSRF_TOKEN']; ?>">
                        <input type="text" name="name" placeholder="Enter School name">
                        <label>
                            <select name="state_id" id="state_id">
                                <option value="">Select a State</option>
                            </select>
                        </label>
                        <button type="submit">Add School</button>
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
                        <th><div class="tables-div">School</div></th>
                        <th><div class="tables-div">State</div></th>
                        <th><div class="tables-div">updated at</div></th>
                        <th><div class="tables-div">created at</div></th>
                        <th><div class="tables-div">action</div></th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>

                <div class="pagination">
                    search: <input type="text" id="keyword" placeholder="Search">
                    <button id="cancel" style="display: none" onclick="gobackagain()">
                        <i class="fa-solid fa-delete-left"></i>
                    </button>
                    <select name="state_id" id="statelist">
                        <option value="0">Select a State</option>
                    </select>
                    <button onclick="search()">🔍</button>
                    total: <span id="total"></span>
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