<div class="logo-menu">
    <input type="checkbox" class="menu-toggle" id="menuToggle">
    <nav class="nav-menu" id="navMenu">
        <div class="menu-section">
            <h3><i class="fas fa-home"></i> Home</h3>
            <a href="/index.php" class="menu-item">
                <i class="fa-solid fa-house"></i>
                الصفحة الرئيسية
            </a>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <a href="/login/index.php" class="menu-item">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    تسجيل الدخول
                </a>
                <a href="/get_account/index.php" class="menu-item">
                    <i class="fa-solid fa-circle-check"></i>
                    تفعيل الحساب
                </a>
            <?php } else { ?>
                <a href="/apps/dashboard/index.php" class="menu-item">
                    <i class="fa-solid fa-grip"></i>
                    اللوحة الرئيسية
                </a>

                <a href="/apps/tasks/index.php" class="menu-item">
                    <i class="fa-solid fa-list-check"></i>
                    قائمة المهام
                </a>

                <?php
                if ($_SESSION['user_role'] === "teacher") { ?>
                    <a href="/marks/teacher_index.php" class="menu-item">
                        <i class="fa-solid fa-chart-line"></i>
                        تسجيل تقارير الطلاب
                    </a>
                <?php } else if ($_SESSION['user_role'] === "student") { ?>
                    <a href="/marks/student_marks_view.php" class="menu-item">
                        <i class="fa-solid fa-chart-line"></i>
                        تقارير الطالب
                    </a>
                <?php } else if ($_SESSION['user_role'] === "parent") { ?>
                    <a href="/marks/parent_index.php" class="menu-item">
                        <i class="fa-solid fa-chart-line"></i>
                        تقارير الابناء
                    </a>
                <?php } ?>
                <a href="/settings/index.php" class="menu-item">
                    <i class="fa-solid fa-gear"></i>
                    الاعدادات
                </a>
                <a href="/login/includes/logout.inc.php" class="menu-item">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    تسجيل الخروج
                </a>
            <?php } ?>
            <a href="/aboutus/index.php" class="menu-item">
                <i class="fa-solid fa-address-card"></i>
                من نحن
            </a>
        </div>

        <?php if (isset($_SESSION['user_id'])) { ?>
            <div class="menu-section">
                <h3><i class="fa-regular fa-comments"></i>Community</h3>
                <?php if ($_SESSION['user_role'] === "parent") { ?>
                    <a href="/announcement/parent_index.php" class="menu-item">
                        <i class="fa-solid fa-scroll"></i> إعلانات المدرسة
                    </a>
                <?php } else { ?>
                    <a href="/community/index.php" class="menu-item">
                        <i class="fa-solid fa-comments"></i> مجتمع الأسئلة والأجوبة
                    </a>
                    <a href="/announcement/index.php" class="menu-item">
                        <i class="fa-solid fa-scroll"></i> إعلانات المدرسة
                    </a>
                    <a href="/apps/leaderboard/index.php" class="menu-item">
                        <i class="fa-solid fa-ranking-star"></i>
                        لوحة المتصدرين
                    </a>
                    <a href="/apps/streams/index.php" class="menu-item">
                        <i class="fa-solid fa-podcast"></i>
                        منصة البث المباشر
                    </a>
                <?php } ?>
                <a href="/apps/motivation/index.php" class="menu-item">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    رسائل العزيمة
                </a>
            </div>

            <div class="menu-section">
                <h3><i class="fas fa-home"></i>Tools</h3>

                <a href="/apps/ai/index.php" class="menu-item">
                    <i class="fas fa-robot"></i>
                    Tont-Assistant
                </a>

                <a href="/apps/path-finder/index.php" class="menu-item">
                    <i class="fa-solid fa-compass"></i>
                    بوصلة الشغف
                </a>

                <a href="/apps/vark2/index.php" class="menu-item">
                    <i class="fa-solid fa-brain"></i>
                    ذاكر بطريقتك
                </a>
                <a href="/apps/mistake_notebook/index.php" class="menu-item">
                    <i class="fa-solid fa-circle-xmark"></i>
                    كراسة الأخطاء
                </a>
                <a href="/apps/notebook/notes/index.php" class="menu-item">
                    <i class="fa-solid fa-note-sticky"></i>
                    دفتر الملاحظات
                </a>
                <a href="/apps/allinone/index.php" class="menu-item">
                    <i class="fa-solid fa-graduation-cap"></i>
                    ما تقدمه الوزارة
                </a>
            </div>
        <?php } ?>
    </nav>

    <!-- <i class="fas fa-bars"></i>
</button> -->
    <a href="/index.php" class="logo">
        <i class="fas fa-graduation-cap"></i> تونت
    </a>
</div>

<div class="header-actions">
    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>
    <?php if (isset($ai_history)) { ?>
        <div class="img-container theme-toggle">
            <i class="fa-solid fa-clock-rotate-left" id="history-toggle"></i>
        </div>
        <?php

    }
    if (!isset($_SESSION['user_id'])) {
        ?>
        <a href="/login" class="btn-register">تسجيل الدخول</a>
    <?php } ?>
</div>