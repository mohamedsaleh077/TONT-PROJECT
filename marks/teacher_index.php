<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
require_once './includes/get_students.php' ;

//require_once "./includes/login_view.inc.php";

if ($_SESSION['user_role'] === "teacher") {
?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

        <head>
           <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
            <link rel="stylesheet" href="main.css">

            <title>المتابعة</title>
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
                <main>
            <section class="school-search">
                <div class="search-header">
                    <h2>البحث عن الطلاب</h2>
                    <p>ابحث عن كل طالب من طلابك</p>
                </div>


                <div class="search-form">
                    <select name="grades" id="grade-select">
                        <option value="">--اختر صفًا--</option>
                        <option value="first_primary">1</option>
                        <option value="second_primary">2</option>
                        <option value="third_primary">3</option>
                        <option value="fourth_primary">4</option>
                        <option value="fifth_primary">5</option>
                        <option value="sixth_primary">6</option>
                        <option value="first_preparatory">7</option>
                        <option value="second_preparatory">8</option>
                        <option value="third_preparatory">9</option>
                        <option value="first_secondary">10</option>
                        <option value="second_secondary">11</option>
                        <option value="third_secondary">12</option>
                    </select>

                    <input type="text" placeholder="اسم الطالب">
                    <input type="text" placeholder="كود الطالب">
                    <button class="search-btn">بحث</button>
                </div>

                <div class="school-table-container">
                    <table class="school-table">
                        <tbody>
                            <?php print_student_list($pdo, $_SESSION['school_id']); ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
            <footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
            </footer>

            <script src="/assets/scripts/script.js"></script>
            <script src="sersh.js"></script>
        </body>

    </html>
    <?php
} else {
    header("Location: /login/index.php");
    die();
}
    ?>
