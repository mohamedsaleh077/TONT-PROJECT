<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";

//require_once "./includes/login_view.inc.php";

if ($_SESSION['user_role'] === "parent") {
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="/marks/main.css">

        <title>قائمة المدارس</title>
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
                <h2>المدارس</h2>
            </div>
            <div class="search-form">
                <!-- ADDED id="searchInput" AND UPDATED PLACEHOLDER -->
                <input type="text" id="searchInput" placeholder="بحث باسم المدرسة أو المحافظة">
                <!-- REMOVED onclick="filterTable()" FROM BUTTON as 'oninput' on the field is sufficient -->
                <button class="search-btn">بحث</button>
            </div>
            <div class="school-table-container">
                <table class="school-table">
                    <!-- ADDED id="schoolTableBody" -->
                    <tbody id="schoolTableBody">
                    <?php
                    $query = "SELECT * from schools JOIN states ON states.id = schools.states_id;";

                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $student_list = $stmt->fetchAll();

                    $pdo = null;
                    $stmt = null;

                    // Header Row
                    echo '<tr><td>اسم المدرسة</td><td>المحافظة</td></tr>';

                    // Data Rows
                    foreach ($student_list as $value) {
                        $url = "index.php?id=" . htmlspecialchars($value['id']) . "&name=" . htmlspecialchars($value['school_name']);

                        // ADDED class='school-row' for JavaScript targeting
                        echo "<tr class='school-row'>";

                        // CORRECTED ORDER: School Name (school_name) under 'اسم المدرسة'
                        echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars($value['school_name']) . "</a></td>";

                        // CORRECTED ORDER: State Name (name) under 'المحافظة'
                        echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars($value['name']) . "</a></td>";

                        // Fixed broken HTML tag issue
                        echo "</tr>";
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

    <!-- INJECTED THE FULL CLIENT-SIDE SEARCH SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');

            // ربط الدالة بحدث الكتابة (oninput) لفلترة فورية
            searchInput.addEventListener('input', filterTable);

            // إضافة مستمع حدث للزر أيضاً (اختياري)
            document.querySelector('.search-btn').addEventListener('click', filterTable);
        });


        function filterTable() {
            const input = document.getElementById('searchInput');
            // تحويل مدخلات المستخدم إلى أحرف كبيرة للتأكد من عدم الحساسية لحالة الأحرف
            const filter = input.value.toUpperCase();
            const tbody = document.getElementById('schoolTableBody');
            // الحصول على جميع الصفوف (بناءً على الصنف school-row)
            const rows = tbody.getElementsByClassName('school-row');

            // المرور على جميع الصفوف
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];

                // جلب جميع خلايا (td) في الصف
                const cells = row.getElementsByTagName('td');

                // التحقق من اسم المدرسة (الخلية الأولى) واسم المحافظة (الخلية الثانية)
                const schoolCell = cells[0];
                const stateCell = cells[1];

                // التحقق من وجود الخلايا أولاً
                if (schoolCell && stateCell) {
                    const schoolText = schoolCell.textContent || schoolCell.innerText;
                    const stateText = stateCell.textContent || stateCell.innerText;

                    // دمج النصين للبحث فيهما
                    const combinedText = (schoolText + " " + stateText).toUpperCase();

                    // التحقق مما إذا كان النص المدخل موجوداً في محتوى الصف
                    if (combinedText.indexOf(filter) > -1) {
                        row.style.display = ""; // إظهار الصف
                    } else {
                        row.style.display = "none"; // إخفاء الصف
                    }
                }
            }
        }
    </script>
    </body>

    </html>
    <?php
} else {
    header("Location: /login/index.php");
    die();
}
?>
