<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: /login/index.php");
    die();
}


if (isset($_GET['id'])) {
    $_SESSION['student_id'] = $_GET['id'];
} else {
    $_SESSION['student_id'] = $_SESSION['ref_id'];
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <title>المتابعة والتقارير</title>
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
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
<?php if ($_SESSION['user_role'] === 'parent') { ?>
    <script>
        let analyis_prompt = "بناء علي التقرير المرفق لهذا الطالب قم باعطاء نصائح لوالده"
    </script>
<?php } else { ?>
    <script>
        let analyis_prompt = "بناء علي التقرير المرفق لهذا الطالب قم باعطاء نصائح له"
    </script>
<?php } ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/marks/student_body.php'; ?>

<footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="/marks/student.js"></script>
<script src="/assets/scripts/script.js"></script>
</body>

</html>