<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/input_validation.inc.php";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>إنشاء حساب جديد - تونت</title>
        <link rel="stylesheet" href="/assets/styles/demo_setup/create.css"/>

    </head>

    <body>

    <header class="header">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head_items.php'; ?>
    </header>


        <!-- Navigation Menu (Sidebar) -->
        <nav class="nav-menu" id="navMenu">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/nav.php'; ?>
        </nav>

        <div class="container">

            <?php 
                if (isset($_GET['err'])){
                    show_errors($_SESSION[ "err" ]);
                }
            ?>
            <!-- Tabs -->
            <div class="tabs">
                <button class="tab-btn active" data-tab="schools">🏫 المدارس</button>
                <button class="tab-btn" data-tab="parents">👨‍👩‍👧 أولياء الأمور</button>
                <button class="tab-btn" data-tab="students">🎓 الطلاب</button>
                <button class="tab-btn" data-tab="teachers">👩‍🏫 المعلمين</button>
            </div>

            <!-- Schools -->
            <div id="schools" class="tab-content active">
                <a href="../school/index.php"><button>ADD SCHOOLS</button></a>
                <table>
                    <thead>
                        <tr><th>ID</th><th>اسم المدرسة</th></tr>
                    </thead>
                    <tbody>
                        <!--schools data goes here--> 
                        <?php require_once './schools/print.php'; ?>
                    </tbody>
                </table>
            </div>

            <!-- Parents -->
            <div id="parents" class="tab-content">
                <form method="POST" action="parents/create.php">
                    <input type="text" placeholder="الاسم الكامل" required name="full_name">
                    <input type="text" placeholder="الرقم القومي (14 رقم)" required maxlength="14" name="nation_id">
                    <button type="submit">➕ إضافة</button>
                </form>
                <table>
                    <thead>
                        <tr><th>ID</th><th>الاسم</th><th>الرقم القومي</th></tr>
                    </thead>
                    <tbody>

                        <?php require_once './parents/print.php'; ?>

                    </tbody>
                </table>
            </div>

            <!-- Students -->
            <div id="students" class="tab-content">
                <form method="POST" action="studetns/create.php">
                    <input type="number" placeholder="School ID" required name="school_id">
                    <input type="text" placeholder="الاسم الكامل" required name="fullname">
                    <input type="text" placeholder="الصف (ex: 11)" required maxlength="2" name="grade">
                    <input type="text" placeholder="الرقم القومي (14 رقم) للطالب"  required maxlength="14"  name="student_nation_id">
                    <input type="text" placeholder="الرقم القومي (14 رقم) لولي الأمر"  required maxlength="14"  name="parent_nation_id">
                    <button type="submit">➕ إضافة</button>
                </form>
                <table>
                    <thead>
                        <tr><th>ID</th><th>المدرسة</th><th>الاسم</th><th>اسم ولي الامر</th><th>الصف</th><th>الرقم القومي للطالب</th></tr>
                    </thead>
                    <tbody>
                        <?php require_once './studetns/print.php'; ?>
                    </tbody>
                </table>
            </div>

            <!-- Teachers -->
            <div id="teachers" class="tab-content">
                <form method="POST" action="teachers/create.php">
                    <input type="text" placeholder="الاسم الكامل" required name="fullname">
                    <input type="number" placeholder="School ID" required name="school_id">
                    <input type="text" placeholder="المادة" required maxlength="50"  name="subject">
                    <input type="text" placeholder="الرقم القومي (14 رقم)" required maxlength="14"  name="teacher_nation_id">
                    <button type="submit">➕ إضافة</button>
                </form>
                <table>
                    <thead>
                        <tr><th>ID</th><th>الاسم</th><th>School</th><th>المادة</th><th>الرقم القومي</th></tr>
                    </thead>
                    <tbody>
                        <?php require_once './teachers/print.php'; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <script>
            const tabs = document.querySelectorAll(".tab-btn");
            const contents = document.querySelectorAll(".tab-content");

            // remove all active on load
            tabs.forEach(t => t.classList.remove("active"));
            contents.forEach(c => c.classList.remove("active"));

            // Load last tab from localStorage (default = schools)
            const lastTab = localStorage.getItem("activeTab") || "schools";
            document.querySelector(`[data-tab="${lastTab}"]`).classList.add("active");
            document.getElementById(lastTab).classList.add("active");

            // Tab click event
            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    tabs.forEach(t => t.classList.remove("active"));
                    tab.classList.add("active");

                    contents.forEach(c => c.classList.remove("active"));
                    document.getElementById(tab.dataset.tab).classList.add("active");

                    // Save selected tab
                    localStorage.setItem("activeTab", tab.dataset.tab);
                });
            });
        </script>
        <script src="/assets/scripts/script.js"></script>
<!--        <script src="/assets/scripts/demo_setup/create.js"></script>-->
    </body>

</html>