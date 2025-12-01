<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
if (isset ($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="main.css"/>
        <title>
            الاعدادات
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
            <h2>مرحباً بك، <?= htmlspecialchars($_SESSION['fullname']) ?>! 🎓</h2>
            <div class="section-title">
                <i class="fa-solid fa-user"></i> تحديث الصورة الشخصية
            </div>
            <div class="pfp-update input-group">
                <form method="post" action="./includes/update_pfp.inc.php" enctype="multipart/form-data">
                    <img src="/settings/pfps/<?= $_SESSION['pfp'] ?>" alt="" id="image-view">
                    <input
                            type="file"
                            maxlength="2048"
                            name="pfp"
                            id="pfp"
                            accept="image/*"
                            style="display: none;"
                    >
                    <input type="hidden" name="token" value="<?= $_SESSION["CSRF_TOKEN"] ?>">
                    <input type="radio" id="change" name="mode" value="change" style="display: none;"/>
                    <input type="radio" id="delete" name="mode" value="delete" style="display: none;"/>
                    <input type="radio" id="keep" name="mode" value="keep" checked style="display: none;"/>
                    <div class="action-button">
                        <button type="button" id="select-btn">Upload New One</button>
                        <button type="submit" id="clear-btn"
                                <?php if ($_SESSION['pfp'] === 'default.jpg') echo 'style="display: none;"' ?>
                        >Delete
                        </button>
                        <!-- style controlled with PHP -->
                        <input type="submit" value="Save Changes">
                    </div>
                    <?php
                    if ($_GET['pfp'] === 'done') {
                        echo "<p>تم تحديث صورة الملف الشخصي</p>";
                    }
                    ?>
                    <script>
                        const reader = new FileReader();
                        const fileInput = document.getElementById("pfp");
                        const selectButton = document.getElementById('select-btn');
                        const imageView = document.getElementById('image-view');
                        const clearButton = document.getElementById('clear-btn');

                        const changeRadio = document.getElementById('change');
                        const deleteRadio = document.getElementById('delete');
                        const keepRadio = document.getElementById('keep');

                        selectButton.addEventListener('click', () => {
                            fileInput.click();
                        });

                        clearButton.addEventListener('click', () => {
                            fileInput.value = '';
                            imageView.src = "/settings/assets/default.jpg";
                            clearButton.style.display = 'none';
                            deleteRadio.checked = true;
                        });

                        fileInput.addEventListener('change', e => {
                            const f = e.target.files[0];
                            reader.readAsDataURL(f);
                            console.log(e.target.files[0]);
                            changeRadio.checked = true;
                        })

                        reader.onload = e => {
                            imageView.src = e.target.result;
                            clearButton.style.display = 'inline-block';
                            imageView.style.height = '500px';
                        }
                    </script>

                </form>

            </div>
            <?php print_saved_errors(); ?>
            <div class="section-title">
                <i class="fa-solid fa-user"></i> تحديث البريد الالكتروني
            </div>
            <?php
            if ($_GET['email'] === 'done') {
                echo "<p>تم تحديث البريد الالكتروني</p>";
            }
            ?>
            <div class="email-update input-group">
                <form method="post" action="./includes/update_email.inc.php">
                    <input type="hidden" name="token" value="<?= $_SESSION["CSRF_TOKEN"] ?>">
                    <input type="email" maxlength="255" name="email" required
                           value="<?= htmlspecialchars($_SESSION['email']) ?>" placeholder="Email">
                    <input type="submit" value="Save Changes">
                </form>
            </div>

            <div class="section-title">
                <i class="fa-solid fa-user"></i> تحديث كلمة المرور
            </div>
            <?php
            if ($_GET['pwd'] === 'done') {
                echo "<p>تم تحديث كلمة المرور</p>";
            }
            ?>
            <div class="password-update input-group">
                <form method="post" action="./includes/update_password.inc.php">
                    <input type="hidden" name="token" value="<?= $_SESSION["CSRF_TOKEN"] ?>">
                    <input type="password" maxlength="255" name="old" required placeholder="Old Password">
                    <input type="password" maxlength="255" name="new" required placeholder="New Password">
                    <input type="password" maxlength="255" name="confirm" required placeholder="Confirm New Password">
                    <input type="submit" value="Save Changes">
                </form>
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