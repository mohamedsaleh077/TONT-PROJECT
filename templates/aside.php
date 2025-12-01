<aside class="sidebar">
    <div class="profile-header">
        <img src="/settings/pfps/<?= $_SESSION['pfp'] ?>" alt="profile">
        <h3>
            <?= htmlspecialchars($_SESSION['fullname']) ?>
        </h3>

        <?php if ($_SESSION['user_role'] === 'teacher') {
            echo '<div class="role-badge">' . htmlspecialchars($_SESSION['user_role']) . '</div>'
                    . '<div class="role-badge">' . htmlspecialchars($_SESSION['subject']) . '</div>'
                    . '<div class="role-badge">' . htmlspecialchars($_SESSION['school_name']) . '</div>';
        } else {
            echo '<div class="role-badge">' . htmlspecialchars($_SESSION['user_role']) . '</div>'
                    . '<div class="role-badge">' . htmlspecialchars($_SESSION['school_name']) . '</div>';
        } ?>

        <p>
            <?= ($_SESSION['user_role'] === 'student') ? 'المرحلة: ' . htmlspecialchars($_SESSION['grade']) : ""; ?>
        </p>
    </div>
    <ul class="profile-menu">
        <?php if ($_SESSION['user_role'] === 'student') { ?>
            <li class="profile-menu-item">
                <a href="/apps/tasks/index.php" class="profile-menu-link">
                    <i class="fas fa-tasks"></i>
                    مهامي
                </a>
            </li>
            <li class="profile-menu-item">
                <a href="/marks/student_marks_view.php" class="profile-menu-link">
                    <i class="fas fa-chart-line"></i>
                    تقرير التقدم
                </a>
            </li>
        <?php } else if ($_SESSION['user_role'] === 'parent') { ?>
            <li class="profile-menu-item">
                <a href="/marks/parent_index.php" class="profile-menu-link">
                    <i class="fas fa-chart-line"></i>
                    تقرير التقدم للأبناء
                </a>
            </li>
        <?php } else if ($_SESSION['user_role'] === 'teacher') { ?>
            <li class="profile-menu-item">
                <a href="/marks/teacher_index.php" class="profile-menu-link">
                    <i class="fas fa-chart-line"></i>
                    متابعة الطلاب
                </a>
            </li>
        <?php } ?>
        <?php if (!isset($dashboard)) { ?>
        <li class="profile-menu-item">
            <a href="/apps/dashboard/index.php" class="profile-menu-link">
                <i class="fa-solid fa-grip"></i>
                اللوحة الرئيسية
            </a>
        </li>
        <?php } ?>
        <li class="profile-menu-item">
            <a href="/settings/index.php" class="profile-menu-link">
                <i class="fa-solid fa-gear"></i>
                الاعدادات
            </a>
        </li>
</aside>