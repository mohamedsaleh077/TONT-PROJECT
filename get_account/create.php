<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
if(!isset($_SESSION['nation_id'])){
    header('Location: index.php');
    exit();
}

//if(!$_SESSION['nation_id_have_account']){
//    header('Location: index.php');
//    exit();
//}

require_once './includes/get_account.inc.view.php';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="/assets/styles/login/main.css">

        <title>تفعيل الحساب</title>
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
                            هيا بنا فلنعد لك حسابك!
                        </h1>
                        <p class="login-subtitle">
                            قم بمراجعة بياناتك! إذا كانت خاطئة تواصل مع إدارة المدرسة! ,قم بربط بياناتك ببريد إلكتروني وكلمة مرور ولا تنساهم حيث ستقوم بإستخدامهم في تسجيل الدخول لاحقًا
                        </p>
                    </div>

                    <div class="divider">
                        <span>
                            بياناتك المسجلة في قواعد البيانات الخاصة بنا
                        </span>
                    </div>
                    
                    <?php echo_all_info($pdo); ?>

                    <div class="divider">
                        <span>
                            قم بإنشاء بيانات الدخول
                        </span>
                    </div>
                    <?php 
                    if (isset($_GET['err']) && isset($_SESSION[ "err" ])){
                       show_errors($_SESSION[ "err" ]); 
                    } 
                    ?>
                    <form id="loginForm" method="post" action="includes/create.inc.php">
                        <div class="form-group">
                            <label class="form-label" for="loginEmail">البريد الإلكتروني</label>
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="text" id="loginEmail" name="email" class="form-input" required placeholder='البريد الإلكتروني'>
                        </div>

                        <div class="form-group password-group">
                            <label class="form-label" for="loginPassword">كلمة المرور</label>
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" id="loginPassword" name="pwd" class="form-input" required  placeholder='كلمة المرور'>
                            <button type="button" class="password-toggle" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>


                        <button type="submit" class="login-btn" id="loginBtn">
                            <i class="fas fa-sign-in-alt" style="margin-left: 0.5rem;"></i>
                            حفظ المعلومات
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
    </body>

</html>
