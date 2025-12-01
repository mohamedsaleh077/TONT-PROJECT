<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
if (isset ($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] === 'parent' && !isset($_GET['id'])) {
        header("Location: parent_index.php");
        die();
    }
    if ($_SESSION['user_role'] === 'parent' && isset($_GET['id'])) {
        $_SESSION['school_id'] = $_GET['id'];
        $_SESSION['school_name'] = $_GET['name'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>
            منشورات مدرسة <?= $_SESSION['school_name'] ?>
        </title>
        <link rel="stylesheet" href="main.css">
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
            <h1>الاعلانات المدرسية - مدرسة <?= $_SESSION['school_name'] ?></h1>
            <?php if ($_SESSION['user_role'] === 'teacher') { ?>
                <section class="evaluation-section">
                    <div class="evaluation-header">
                        <h2><i class="fa-solid fa-pen-to-square"></i> إنشاء منشور</h2>
                    </div>
                    <form accept-charset="UTF-8" action="./includes/create.inc.php" method="post" enctype="multipart/form-data">
                        <?php
                        print_saved_errors();
                        ?>
                        <div class="post-form">
                            <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    placeholder="عنوان المنشور"
                                    required
                                    maxlength="250"
                            >
                            <textarea
                                    id="body"
                                    name="body"
                                    placeholder="محتوي المنشور"
                                    rows="5"
                                    maxlength="1000"
                            ></textarea>
                            <input type="hidden" name="token" value="<?= $_SESSION["CSRF_TOKEN"] ?>">
                            <input type="submit" value="نشر" class="platform-link"
                                   style="background-color: #00a033; color: #ffffff;">
                            <button id="select-btn" class="submit platform-link" type="button">أرفق ملفًا</button>
                            <button id="clear-btn" class="submit platform-link" type="button">حذف</button>
                            <div id="image-view">معاينة الصورة المصغرة للمنشور:</div>
                            <input type="file" name="media" id="pfp"
                                   accept="image/jpg, image/png, image/jpeg, image/webp, image/gif, video/mp4, video/webm, audio/mpeg, application/pdf">
                        </div>
                    </form>
                </section>
                <h1>المنشورات:</h1>
            <?php } ?>
            <!--                <select name="grades" id="grade-select">-->
            <!--                    <option value="">تصنيف حسب</option>-->
            <!--                </select>-->
            <div class="post-form search">
                <input id="search" type="text" placeholder="كلمة مفتاحية من المنشور...">
                <button class="platform-link" style="display: none" id="clear">مسح</button>
                <button class="platform-link" id="search-btn">بحث</button>
            </div>
            <div id="feed">

            </div>
            <p id="more">تحميل المزيد...</p>


            <script>
                const reader = new FileReader();
                const fileInput = document.getElementById("pfp");
                const selectButton = document.getElementById('select-btn');
                const imageView = document.getElementById('image-view');
                const clearButton = document.getElementById('clear-btn');

                selectButton.addEventListener('click', () => {
                    fileInput.click();
                });

                clearButton.addEventListener('click', () => {
                    fileInput.value = '';
                    imageView.style.backgroundImage = "";
                    clearButton.style.display = 'none';
                    imageView.style.height = '0px';
                });

                fileInput.addEventListener('change', e => {
                    const f = e.target.files[0];
                    reader.readAsDataURL(f);
                    console.log(e.target.files[0]);
                    selectButton.innerText = 'تغيير الملف';
                })

                reader.onload = e => {
                    imageView.style.backgroundImage = 'url("' + e.target.result + '")';
                    clearButton.style.display = 'inline-block';
                    imageView.style.height = '500px';
                }
            </script>
            <script src="/assets/scripts/script.js"></script>
            <script src="request.js"></script>
    </body>
    </html>

    <?php
} else {
    header("Location: /login/index.php");
    die ();
}
?>