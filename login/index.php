<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
//require_once "./includes/login_view.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/input_validation.inc.php";
if (!isset($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head>
        <?php require_once __DIR__ . '/../templates/head.php'; ?>
        <link rel="stylesheet" href="/assets/styles/login/main.css">

        <title>Log in</title>
    </head>

    <body>
    <!-- Menu Overlay -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <header>
        <div class="header-container">
            <!-- Menu Toggle Button -->
            <?php require_once __DIR__ . '/../templates/head_items.php'; ?>
        </div>
    </header>

    <!-- Navigation Menu (Sidebar) -->
    <nav class="nav-menu" id="navMenu">
        <?php require_once __DIR__ . '/../templates/nav.php'; ?>
    </nav>

    <div class="main-container">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="welcome-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h1 class="login-title">أهلاً بعودتك</h1>
                    <p class="login-subtitle">سجل دخولك للوصول إلى حسابك ومتابعة رحلتك التعليمية</p>
                </div>
                <?php show_errors($_SESSION["ErrorLogin"]); ?>
                <form id="loginForm" method="POST" action="includes/login.inc.php">
                    <input type="hidden" name="token" value="<?= $_SESSION["CSRF_TOKEN"] ?>">
                    <div class="form-group">
                        <label class="form-label" for="loginEmail">البريد الإلكتروني أو اسم المستخدم</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="text" id="loginEmail" name="loginEmail" class="form-input" required placeholder="البريد الالكتروني">
                    </div>

                    <div class="form-group password-group">
                        <label class="form-label" for="loginPassword">كلمة المرور</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="loginPassword" name="loginPassword" class="form-input" required placeholder="كلمة المرور">
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-options">
                        <!--                            <label class="remember-me">-->
                        <!--                                <input type="checkbox" id="rememberMe" name="rememberMe">-->
                        <!--                                <span>تذكرني</span>-->
                        <!--                            </label>-->
                        <a href="/get_account/index.php" class="forgot-password">ليس لديك حساب؟؟</a>
                    </div>

                    <button type="submit" class="login-btn" id="loginBtn">
                        <i class="fas fa-sign-in-alt" style="margin-left: 0.5rem;"></i>
                        تسجيل الدخول
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <footer>
        <?php require_once __DIR__ . '/../templates/footer.php'; ?>
    </footer>

    <script src="/assets/scripts/script.js"></script>
    <script src="/assets/scripts/login/sctipt.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const myParamValue = urlParams.get('demo');

        const email = "@email.com"
        const username = document.getElementById("loginEmail");
        const password = document.getElementById("loginPassword");

        let user = "";

        switch (myParamValue){
            case "p":
                user = "parent";
                break;
            case "s":
                user = "student";
                break;
            case "t":
                user = "teacher";
                break;
            default:
                user = "";
                break;
        }

        console.log(user);
        console.log(myParamValue);

        if (user !== ""){
            username.value = user + email;
            password.value = "password"
        }
    </script>
    </body>

    </html>
<?php } else {
    header("Location: /apps/dashboard/index.php");
    die();
}
?>