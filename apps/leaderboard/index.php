<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config_session.inc.php';

if (!isset($_SESSION['school_id'])) {
    header('Location: /apps/dashboard/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>leaderboard</title>

        <link rel="stylesheet" href="/assets/styles/leaderboard/main.css">
        <link rel="stylesheet" href="/assets/styles/legacy/main.css">
        <link rel="stylesheet" href="/assets/styles/legacy/mobile.css">
    </head>

    <body>
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

            <div class="QuestionBlook">

                <div class="centered-H1">لوحة المتصدرين</div>

                <div class="THEleaderboard">
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
                    $school_id = $_SESSION['school_id'];
                    $query = "SELECT
                                e.student_id,
                                s.fullname,
                                SUM(e.full_mark) AS Total_Full_Marks,
                                SUM(e.student_mark) AS Total_Student_Marks
                            FROM
                                exams e
                            JOIN
                                students s ON s.id = e.student_id
                            JOIN
                                schools S ON S.id = s.school_id
                            WHERE
                                S.id = :school_id
                            GROUP BY
                                e.student_id, s.fullname
                            ORDER BY
                                Total_Student_Marks DESC
                            LIMIT 0, 25;";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":school_id", $school_id);
                    $stmt->execute();
                    $student_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $pdo = null;
                    $stmt = null;

                    $i = 0;
                    foreach ($student_list as $value) {
                        $i++;
                    ?>
                    <div class="leaderboardBlock">
                        <p class="leaderboardName"><?= $i . " - " . $value['fullname']; ?></p>
                        <div class="leftLeaderboard">
                            <p class="leaderboardPTS"><?= $value['Total_Student_Marks']; ?> PPT</p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>

            </div>

        </main>


        <script src="/assets/scripts/script.js"></script>

    </body>

</html>