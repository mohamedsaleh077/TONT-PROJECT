<?php

use oop\SessionManager;

require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/SessionManager.php";

$session = new SessionManager();
$session->start_session();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <title>تسجيل الدخول الي اللوحة الادارية</title>
    <link rel="stylesheet" href="/assets/styles/login/main.css">
    <link rel="stylesheet" href="panels/login.css">
</head>

<body>
<div class="main-container">
    <div class="login-container">
        <h1 class="login-title">مرحبا بك في tont-myadmin</h1>
        <form id="loginForm" method="POST" action="handler/login.php">
            <input type="hidden" name="token" value="<?= $session->getCSRFToken(); ?>">
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="error-message" style="display: block;">
                    <?php $session->print_saved_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="form-label" for="loginEmail">اسم المستخدم</label>
                <input type="text" id="loginEmail" name="username" class="form-input" required>
            </div>

            <div class="form-group password-group">
                <label class="form-label" for="loginPassword">كلمة المرور</label>
                <input type="password" id="loginPassword" name="pwd" class="form-input" required>
            </div>
            <button type="submit" class="login-btn" id="loginBtn">
                دخول
            </button>
        </form>
    </div>
</div>
<script src="/assets/scripts/script.js"></script>
</body>

</html>