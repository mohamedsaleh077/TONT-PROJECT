<?php
$dashboard = true;
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
if (isset ($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="main.css"/>
        <title>
            Dashboard
        </title>
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

    <!-- Page Content - StudyTont -->
    <div class="container">
        <!-- Sidebar -->
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aside.php'; ?>

        <!-- Main -->
        <main class="main">
            <div class="welcome-banner">
                <h2>مرحباً بعودتك، <?= htmlspecialchars($_SESSION['fullname']) ?>! 🎓</h2>
                <?php if ($_SESSION['user_role'] === 'student') { ?>
                    <p>لديك 3 واجبات قادمة و حصتين اليوم. استمر في العمل الجيد!</p>
                    <div class="banner-actions">
                        <a href="/apps/tasks/index.php">
                            <button class="btn btn-primary">عرض جدول اليوم</button>
                        </a>
                        <a href="/apps/allinone/index.php">
                            <button class="btn btn-outline">رؤية الواجبات</button>
                        </a>
                    </div>
                <?php } else if ($_SESSION['user_role'] === 'teacher') { ?>
                    <p>
                        سعداء برؤيتك! يمكنك تقييم طلابك, تحضير البث المباشر, النشر والتواصل علي المجتمع!
                    </p>
                <?php } else if ($_SESSION['user_role'] === 'parent') { ?>
                    <p>
                        يمكنك متابعة مستوي أبناؤك من هنا والتواصل مع المعلمين وإدارة المدرسة!
                    </p>
                <?php } ?>
            </div>

            <!-- المجتمع والتواصل -->
            <div class="section-title" style="color: var(--accent-community);">
                <i class="fa-solid fa-users-line"></i> المجتمع والتواصل
            </div>
            <div class="apps">
                <!-- إعلانات المدرسة (تم افتراض رابط إعلانات) -->
                <?php if ($_SESSION['user_role'] === "parent") { ?>
                    <a href="/announcement/parent_index.php" class="app-card community">
                        <i class="fa-solid fa-scroll"></i> إعلانات المدرسة
                    </a>
                <?php } else {?>
                <a href="/announcement/index.php" class="app-card community">
                    <i class="fa-solid fa-scroll"></i> إعلانات المدرسة
                </a>
                <?php } ?>
                <!-- مجتمع الأسئلة والأجوبة (تم افتراض رابط Q&A) -->
                <a href="/community/index.php" class="app-card community">
                    <i class="fa-solid fa-comments"></i> مجتمع الأسئلة والأجوبة
                </a>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== "parent") { ?>
                    <!-- قائمة المتصدرين -->
                    <a href="/apps/leaderboard/index.php" class="app-card community">
                        <i class="fa-solid fa-ranking-star"></i> لوحة المتصدرين
                    </a>
                    <!-- رسائل العزيمة -->
                    <a href="/apps/motivation/index.php" class="app-card community">
                        <i class="fa-solid fa-fire-flame-curved"></i> رسائل العزيمة
                    </a>
                <?php } ?>

            </div>

            <div style="margin-top: 30px;"></div>

            <!-- الواجبات والتقارير -->
            <div class="section-title" style="color: var(--accent-reports);">
                <i class="fa-solid fa-chart-column"></i> الواجبات والتقارير
            </div>
            <div class="apps">
                <!-- قائمة المهام -->
                <a href="/apps/tasks/index.php" class="app-card reports">
                    <i class="fa-solid fa-list-check"></i> قائمة المهام
                </a>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "teacher") { ?>
                    <!-- تسجيل تقارير الطلاب (للمعلم فقط) -->
                    <a href="/marks/teacher_index.php" class="app-card reports">
                        <i class="fa-solid fa-file-pen"></i> تسجيل تقارير الطلاب
                    </a>
                <?php } ?>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "parent") { ?>
                    <!-- منصة البث المباشر (وضع في هذا القسم لقربها من المهام الدراسية) -->
                    <a href="/marks/parent_index.php" class="app-card reports">
                        <i class="fa-solid fa-chart-simple"></i> تقارير الابناء
                    </a>
                <?php } ?>

                <!-- تقارير الطالب (للطالب فقط) -->
                <?php
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "student") { ?>
                    <a href="/marks/student_marks_view.php" class="app-card reports">
                        <i class="fa-solid fa-chart-simple"></i> تقارير الطالب
                    </a>
                <?php } ?>
            </div>

            <div style="margin-top: 30px;"></div>

            <!-- حقيبة الأدوات الذكية -->
            <div class="section-title" style="color: var(--accent-tools);">
                <i class="fa-solid fa-toolbox"></i> حقيبة الأدوات
            </div>
            <div class="apps">
                <!-- Tont Assistant -->
                <a href="/apps/ai/index.php" class="app-card tools">
                    <i class="fa-solid fa-robot"></i> Tont Assistant
                </a>

                <!-- منشيء العادات الجديدة -->
                <a href="/apps/habit-tracker/index.php" class="app-card tools">
                    <i class="fa-solid fa-repeat"></i> منشيء العادات الجديدة
                </a>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "student") { ?>
                    <!-- اختبار ذاكر بطريقتك (VARK) -->
                    <a href="/apps/vark2/index.php" class="app-card tools">
                        <i class="fa-solid fa-brain"></i> اختبار ذاكر بطريقتك
                    </a>

                    <!-- اختبار بوصلة الشغف -->
                    <a href="/apps/path-finder/index.php" class="app-card tools">
                        <i class="fa-solid fa-compass-drafting"></i> اختبار بوصلة الشغف
                    </a>

                    <!-- كراسة الأخطاء -->
                    <a href="/apps/mistake_notebook/index.php" class="app-card tools">
                        <i class="fa-solid fa-eraser"></i> كراسة الأخطاء
                    </a>
                <?php } ?>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== "parent") { ?>
                    <!-- ما يخص الوزارة (للطلاب فقط، حيث المعلم لا يحتاج هذا الرابط بنفس الشكل) -->
                    <a href="/apps/allinone/index.php" class="app-card tools">
                        <i class="fa-solid fa-graduation-cap"></i> ما يخص الوزارة
                    </a>
                    <a href="/apps/streams/index.php" class="app-card tools">
                        <i class="fa-solid fa-podcast"></i> البث المباشر
                    </a>
                <?php } ?>
                <!-- دفتر الملاحظات -->
                <a href="/apps/notebook/notes/index.php" class="app-card tools">
                    <i class="fa-solid fa-note-sticky"></i> دفتر الملاحظات
                </a>

                <!-- موادات -->
                <a href="/apps/material/resources/index.php" class="app-card tools">
                    <i class="fa-solid fa-file"></i>
                    المصادر
                </a>
                <?php if ($_SESSION['user_role'] === "student"){?>
                <!-- شهادات -->
                <a href="/apps/material/certificates/index.php" class="app-card tools">
                    <i class="fa-solid fa-medal"></i>
                    شهادات
                </a>
        <?php } ?>

            </div>
        </main>
    </div>

    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
    </footer>

    <script src="/assets/scripts/script.js"></script>
    </body>
    </html>

    <?php
} else {
    header("Location: /login/index.php");
    die ();
}
?>