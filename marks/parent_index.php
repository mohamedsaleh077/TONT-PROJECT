<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
require_once './includes/get_students.php' ;

//require_once "./includes/login_view.inc.php";

if ($_SESSION['user_role'] === "parent") {
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
                    <h2>الابناء</h2>
                </div>
                <div class="school-table-container">
                    <table class="school-table">
                        <tbody>
                            <?php
                            $query = "SELECT * from students WHERE parent_id =:id;" ;
                            $parent_id = $_SESSION[ 'ref_id' ] ;

                            $stmt = $pdo -> prepare ( $query ) ;
                            $stmt -> bindParam ( ":id" , $parent_id ) ;
                            $stmt -> execute () ;

                            $student_list = $stmt -> fetchAll () ;

                            $pdo = null ;
                            $stmt = null ;

                            echo '<tr><td>كود الطالب</td><td>الاسم</td><td>المرحلة</td></tr>';

                            foreach ( $student_list as $value ) {
                                $url = "student_marks_view.php?id=" . htmlspecialchars ( $value[ 'id' ] ) ;
                                echo "<tr>" ;
                                echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars ( $value[ 'id' ] ) . "</a></td>" ;
                                echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars ( $value[ 'fullname' ] ) . "</a></td>" ;
                                echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars ( $value[ 'grade' ] ) . "</a></td>" ;
                                echo "</a></tr>" ;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
            <footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
            </footer>

            <script src="/assets/scripts/script.js"></script>
        </body>

    </html>
    <?php
} else {
    header("Location: /login/index.php");
    die();
}
    ?>
