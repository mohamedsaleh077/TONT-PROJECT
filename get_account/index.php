<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once  './includes/get_account.inc.view.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/input_validation.inc.php';

if (isset($_SESSION['user_id'])){
    header("Location: /apps/dashboard/index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="/assets/styles/login/main.css">

        <title>استعلام عن حساب</title>
    </head>

    <body>
        <!-- Menu Overlay -->
        <div class="menu-overlay" id="menuOverlay"></div>

        <header>
            <div class="header-container">
                <!-- Menu Toggle Button -->
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head_items.php'; ?>
            </div>
        </header>

        <!-- Navigation Menu (Sidebar) -->
        <nav class="nav-menu" id="navMenu">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/nav.php'; ?>
        </nav>

        <div class="main-container">
            <div class="login-container">
                <div class="login-card">
                    <div class="login-header">
                        <div class="welcome-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <h1 class="login-title">
                            قم بالاستعلام عن حسابك
                        </h1>
                        <p class="login-subtitle">
                            من هنا يمكنك ربط حسابك المسجل سابقَا ببريد إلكتروني وكلمة مرور
                        </p>
                    </div>

                    <?php
                    if (isset($_GET['err']) && isset($_SESSION[ "err" ])){
                       show_errors($_SESSION[ "err" ]);
                    }
                    ?>

                    <form id="loginForm" method="post" action="./includes/get_account.inc.php">
                        <input type="hidden" name="token" value="<?= $_SESSION["CSRF_TOKEN"] ?>">
                        <div class="form-group">
                            <label class="form-label" for="loginEmail">الرقم القومي</label>
                            <div class="input-icon">
                                <i class="fa-solid fa-id-card-clip"></i>
                            </div>
                            <input type="text" class="form-input" required maxlength="14" name="nation_id">
                        </div>

                        <div class="form-group password-group">
                            <label class="form-label" for="role">دورك</label>
                            <div class="input-icon">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <select class="form-input" required name="role">
                                <option value="student">طالب</option>
                                <option value="parent">ولي أمر</option>
                                <option value="teacher">معلم</option>
                            </select>
                        </div>

                        <button type="submit" class="login-btn" id="loginBtn">
                            <i class="fas fa-sign-in-alt" style="margin-left: 0.5rem;"></i>
                            استعلام
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script src="script.js"></script>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
        </footer>

        <script src="/assets/scripts/script.js"></script>
        <script src="/assets/scripts/login/script.js"></script>
    </body>

</html>