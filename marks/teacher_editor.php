<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once './includes/get_students.php';
//require_once "./includes/login_view.inc.php";

if ($_SESSION['user_role'] === "teacher") {
    if (!isset($_GET['id'])) {
        header('Location: /marks/teacher_index.php');
        die();
    }

    $user_id = $_GET['id'];
    $student = student_info($pdo, $user_id);

    if ($student['school_id'] !== $_SESSION['school_id']) {
        header('Location: /marks/teacher_index.php');
        die();
    }
    require_once "./includes/student_report.model.inc.php";
    require_once "./includes/student_report.view.inc.php";

    $exams_data = list_exams($pdo, $student['id'], $_SESSION['subject']);

    $_SESSION['student_id'] = $student['id'];

    require_once "./includes/absence.model.inc.php";
    require_once "./includes/absence.view.inc.php";
    require_once "./includes/behaviour.model.inc.php";
    require_once "./includes/behaviour.view.inc.php";
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="main.css">
        <style>
            /*
            * -----------------------------------------------------------
            * 1. CSS Variables (Originally from styles.css)
            * -----------------------------------------------------------
            */
            :root {
                /* Light theme colors */
                --bg-primary: #ffffff;
                --bg-secondary: #f8fafc;
                --bg-card: #f0f0f0;
                --text-primary: #1f2937;
                --text-secondary: #6b7280;
                --text-muted: #9ca3af;
                --border-color: #e5e7eb;
                --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
                --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
                --accent-blue: #08367f;
                --accent-blue-hover: #0b2c71;
                --accent-yellow: #f59e0b;
                --accent-yellow-hover: #d97706;
                --success: #10b981;
                --danger: #ef4444;
            }

            [data-theme="dark"] {
                /* Dark theme colors */
                --bg-primary: #1a1d29;
                --bg-secondary: #252834;
                --bg-card: #2d3142;
                --text-primary: #ffffff;
                --text-secondary: #a0a6b8;
                --text-muted: #6b7280;
                --border-color: #3a3f52;
                --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
                --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3);
                --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3);
                --accent-blue: #4285f4;
                --accent-blue-hover: #1e40af;
                --accent-yellow: #facc15;
                --accent-yellow-hover: #f59e0b;
                --success: #10b981;
                --danger: #ef4444;
            }

            /*
            * -----------------------------------------------------------
            * 2. Base Styles and Layout (Originally from styles.css and custom)
            * -----------------------------------------------------------
            */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Cairo', sans-serif;
                background: var(--bg-primary);
                color: var(--text-primary);
                line-height: 1.6;
                direction: rtl;
                transition: all 0.3s ease;
                padding-top: 85px; /* Added for header clearance */
            }

            /* Main Container */
            .main-container {
                padding: 1rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            /* Header Styles (Page-specific typography) */
            .page-header {
                margin-bottom: 2rem; /* mb-8 equivalent */
                text-align: right;
            }

            .page-title {
                font-size: 1.875rem; /* text-3xl equivalent */
                font-weight: 800; /* font-extrabold equivalent */
                color: var(--text-primary);
                display: flex;
                align-items: center;
            }

            .page-title i {
                margin-left: 0.5rem; /* ml-2 equivalent */
            }

            .page-subtitle {
                font-size: 1.125rem; /* text-lg equivalent */
                color: var(--text-secondary); /* text-gray-600 equivalent */
                margin-top: 0.25rem; /* mt-1 equivalent */
            }

            .page-subtitle span {
                font-weight: 700;
                color: var(--text-primary);
            }

            /* Dashboard Grid Layout (for main stats) */
            .dashboard-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            /* Card Styles */
            .card {
                background: var(--bg-card);
                border-radius: 0.75rem;
                box-shadow: var(--shadow-md);
                padding: 1.5rem;
                overflow: scroll;
            }

            .card-header {
                border-bottom: 1px solid var(--border-color);
                padding-bottom: 1rem;
                margin-bottom: 1rem;
                display: flex;
                justify-content: flex-end; /* justify-end equivalent */
                width: 100%;
            }

            .card-title {
                display: flex;
                align-items: center;
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--text-primary);
            }

            .card-icon {
                background-color: var(--bg-secondary);
                color: var(--accent-blue);
                border-radius: 50%;
                width: 35px;
                height: 35px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-left: 0.75rem;
                flex-shrink: 0;
            }

            /* Overall Progress Card Specific Styles */
            .card-center-items {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .level-display {
                padding-top: 1rem; /* pt-4 equivalent */
            }

            .total-exams-count {
                margin-top: 1rem; /* mt-4 equivalent */
                text-align: center;
                color: var(--text-secondary); /* text-gray-500 equivalent */
                font-size: 0.875rem; /* text-sm equivalent */
            }

            .total-exams-count span {
                font-weight: 700;
                color: var(--text-primary);
            }

            /* Behavior Card Specific Styles */
            .behavior-stats-container {
                display: flex;
                /*justify-content: space-around;  justify-around equivalent */
                align-items: center;
                /*height: 100%;*/
                min-height: 2rem;
            }

            .stat-item {
                text-align: center;
                padding: 0.75rem; /* p-3 equivalent */
                flex: 1;
            }

            .stat-separator {
                height: 4rem; /* h-16 equivalent */
                width: 1px; /* w-px equivalent */
                background-color: var(--border-color); /* bg-gray-200 equivalent */
                margin: 0 1rem; /* mx-4 equivalent */
            }

            .stat-value {
                font-size: 2.25rem; /* text-4xl equivalent */
                font-weight: 800; /* font-extrabold equivalent */
            }

            .stat-label {
                font-size: 0.875rem; /* text-sm equivalent */
                color: var(--text-secondary); /* text-gray-500 equivalent */
                margin-top: 0.25rem; /* mt-1 equivalent */
            }

            .behavior-bar-wrapper {
                margin-top: 1rem;
            }

            .behavior-bar-bg {
                height: 0.5rem; /* h-2 equivalent */
                background-color: var(--border-color); /* bg-gray-200 equivalent */
                border-radius: 9999px; /* rounded-full equivalent */
            }

            .behavior-bar-fill {
                height: 0.5rem;
                border-radius: 9999px;
                transition: width 0.5s ease-in-out; /* transition-all duration-500 equivalent */
            }

            .behavior-ratio-text {
                font-size: 0.75rem; /* text-xs equivalent */
                text-align: center;
                margin-top: 0.5rem; /* mt-2 equivalent */
                color: var(--text-secondary); /* text-gray-500 equivalent */
            }

            /* AI Tip Card Specific Styles */
            .ca-wrapper {
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .ai-tip-content {
                color: var(--text-secondary); /* text-gray-700 equivalent */
                font-size: 1rem;
                margin-bottom: 1rem; /* mb-4 equivalent */
                overflow: scroll;
                max-height: 200px;
            }

            .ai-tip-content-wrapper {
                height: auto;
            }

            .btn-ai-tip {
                background-color: var(--accent-blue);
                color: white;
                font-weight: 700;
                padding: 0.5rem 1rem; /* py-2 px-4 equivalent */
                border: none;
                border-radius: 0.5rem; /* rounded-lg equivalent */
                transition: background-color 0.3s ease;
                cursor: pointer;
                font-size: 0.9rem;
            }

            .btn-ai-tip:hover {
                background-color: var(--accent-blue-hover); /* hover:bg-indigo-700 equivalent */
            }

            .btn-ai-tip:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            /* Margin utilities */
            .mt-6 {
                margin-top: 1.5rem;
            }

            .p-4 {
                padding: 1rem;
            }


            /* Progress Circle Styling */
            .level-circle {
                position: relative;
                width: 150px;
                height: 150px;
                margin: 0 auto;
            }

            .level-circle svg {
                width: 100%;
                height: 100%;
                transform: rotate(-90deg);
            }

            .progress-bg {
                fill: none;
                stroke: var(--border-color);
                stroke-width: 5;
            }

            .progress-fill {
                fill: none;
                stroke: var(--progress-color, var(--accent-blue));
                stroke-width: 5;
                stroke-linecap: round;
                transition: stroke-dashoffset 0.5s ease-in-out;
                stroke-dasharray: 439.8;
                /* 2 * PI * 70 */
            }

            .level-text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }

            .level-percentage {
                font-size: 2rem;
                font-weight: 700;
                color: var(--text-primary);
            }

            .level-label {
                font-size: 0.875rem;
                color: var(--text-secondary);
            }

            /* Tables and Overflow Control */
            .responsive-table-container {
                overflow-x: auto;
                border: 1px solid var(--border-color);
                border-radius: 0.5rem;
            }

            .exams-table,
            .records-table {
                width: 100%;
                min-width: 700px;
                /* Ensure tables scroll horizontally if narrow */
                border-collapse: collapse;
            }

            .exams-table th,
            .exams-table td,
            .records-table th,
            .records-table td {
                padding: 0.75rem 1rem;
                text-align: right;
                border-bottom: 1px solid var(--border-color);
            }

            .exams-table th,
            .records-table th {
                background-color: var(--bg-secondary);
                font-weight: 700;
                color: var(--text-primary);
            }

            .exams-table tr:hover,
            .records-table tr:hover {
                background-color: var(--bg-secondary);
            }

            /* Semantic Colors for Text */
            .text-success {
                color: var(--success);
            }

            .text-warning {
                color: var(--accent-yellow);
            }

            .text-danger {
                color: var(--danger);
            }

            .text-primary-color {
                color: var(--accent-blue);
            }

            .text-secondary-color {
                color: var(--text-secondary);
            }

            .text-bold {
                font-weight: 700;
            }

            .text-center {
                text-align: center;
            }

            .animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.5;
                }
            }

        </style>
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
        <section class="student-tracking">
            <div class="student-info">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">الاسم:</span>
                        <span class="info-value"><?= htmlspecialchars($student['fullname']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الصف:</span>
                        <span class="info-value"><?= htmlspecialchars($student['grade']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">المادة :</span>
                        <span class="info-value"><?= htmlspecialchars($_SESSION['subject']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">المدرسة:</span>
                        <span class="info-value"><?= htmlspecialchars($_SESSION['school_name']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">كود الطالب:</span>
                        <span class="info-value"><?= htmlspecialchars($student['id']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">كود المدرسة:</span>
                        <span class="info-value"><?= htmlspecialchars($student['school_id']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">اسم المعلم:</span>
                        <span class="info-value"><?= htmlspecialchars($_SESSION['fullname']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">كود المعلم:</span>
                        <span class="info-value"><?= htmlspecialchars($_SESSION['user_id']) ?></span>
                    </div>
                </div>
            </div>

            <div class="tabs">
                <button class="tab active" data-tab="exams">الامتحانات</button>
                <button class="tab" data-tab="attendance">الحضور</button>
                <button class="tab" data-tab="behavior">السلوك</button>
                <button class="tab" data-tab="report">التقرير</button>
            </div>

            <!-- ===========================Exams Tab========================== -->
            <div id="exams" class="tab-content active">
                <?= display_error_message(); ?>
                <form action="./includes/student_report.inc.php" method="POST">
                    <div class="form-grid">

                        <div class="form-group">
                            <label for="examTitle">عنوان الامتحان</label>
                            <input
                                    type="text"
                                    id="examTitle"
                                    name="exam_title"
                                    placeholder="عنوان الامتحان"
                                    required
                            >
                        </div>

                        <div class="form-group">
                            <label for="examMark">الدرجة</label>
                            <input
                                    type="number"
                                    id="examMark"
                                    name="student_mark"
                                    placeholder="الدرجة"
                                    step="0.01"
                                    min="0"
                                    required
                            >
                        </div>

                        <div class="form-group">
                            <label for="fullMark">full mark</label>
                            <input
                                    type="number"
                                    id="fullMark"
                                    name="highest_mark"
                                    placeholder="الدرجة القصوى"
                                    step="0.01"
                                    min="1"
                                    required
                            >
                        </div>

                        <div class="form-group">
                            <label for="examDate">تاريخ الامتحان</label>
                            <input
                                    type="date"
                                    id="examDate"
                                    name="exam_date"
                                    placeholder="تاريخ الامتحان"
                                    required
                            >
                        </div>

                    </div>

                    <div class="form-group submit-group">
                        <button type="submit" name="submit_exam" class="btn-save">حفظ الدرجات</button>
                    </div>
                </form>
                <div class="records-container" style="margin-top: 2rem;">
                    <table class="records-table">
                        <thead>
                        <tr>
                            <th>
                                exam title
                            </th>
                            <th>
                                exam date
                            </th>
                            <th>
                                full mark
                            </th>
                            <th>
                                student mark
                            </th>
                            <th>
                                percent
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= print_exams_table($exams_data); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="attendance" class="tab-content">

                <form action="./includes/absence.inc.php" method="POST" class="form-attendance-record">

                    <h3 class="section-title">تسجيل غياب الطالب</h3>
                    <div class="form-row">

                        <div class="form-group">
                            <label for="absenceDate">تاريخ الغياب</label>
                            <input
                                    type="date"
                                    id="absenceDate"
                                    name="absence_date"
                                    required
                            >
                        </div>
                    </div>

                    <div class="form-group notes-group">
                        <label for="absenceNotes">ملاحظات (اختياري)</label>
                        <textarea
                                id="absenceNotes"
                                name="notes"
                                rows="3"
                                placeholder="أضف أي ملاحظات هامة..."
                        ></textarea>
                    </div>

                    <button type="submit" class="btn-save">حفظ الغياب</button>
                </form>

                <hr style="margin: 2rem 0;">

                <div class="records-container">
                    <h3 class="section-title">سجلات الغياب السابقة</h3>
                    <table class="records-table">
                        <thead>
                        <tr>
                            <th>تاريخ الغياب</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        print_absence_table_rows(list_absence_dates($pdo, $student['id']));
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Behavior Tab -->
            <!-- Behavior Tab Content -->
            <div id="behavior" class="tab-content">

                <!-- Form: Record New Behavior -->
                <form action="./includes/behaviour.inc.php" method="POST" class="form-behavior-record">

                    <h3 style="margin-bottom: 1rem;">تسجيل سلوك جديد (إيجابي / سلبي)</h3>

                    <!-- بيانات أساسية مخفية -->
                    <?php
                    // يجب التأكد من وجود هذه المتغيرات في الجلسة أو نطاق الصفحة
                    $student_id = $_SESSION['student_id'];
                    $teacher_id = $_SESSION['user_id'];
                    ?>
                    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars((string)$student_id); ?>">
                    <input type="hidden" name="teacher_id" value="<?php echo htmlspecialchars((string)$teacher_id); ?>">

                    <div class="form-grid">
                        <!-- Grid Row 1: Type and Date -->

                        <!-- نوع السلوك (إيجابي / سلبي) -->
                        <div class="form-group">
                            <label for="behaviorType">نوع السلوك</label>
                            <select id="behaviorType" name="behaviour_type" required>
                                <option value="">اختر نوع السلوك</option>
                                <option value="إيجابي - تفوق">إيجابي - تفوق</option>
                                <option value="إيجابي - تعاون">إيجابي - تعاون</option>
                                <option value="سلبي - عدم احترام">سلبي - عدم احترام</option>
                                <option value="سلبي - إثارة الشغب">سلبي - إثارة الشغب</option>
                                <option value="سلبي - تنمر">سلبي - تنمر</option>
                                <option value="أخرى">أخرى</option>
                            </select>
                        </div>

                        <!-- تاريخ السلوك -->
                        <div class="form-group">
                            <label for="behaviorDate">تاريخ السلوك</label>
                            <input
                                    type="date"
                                    id="behaviorDate"
                                    name="behaviour_date"
                                    placeholder="تاريخ السلوك"
                                    required
                            >
                        </div>
                    </div>

                    <!-- ملاحظات السلوك (Row 2: Full Width) -->
                    <div class="form-group">
                        <label for="behaviorNotes">ملاحظات/وصف السلوك</label>
                        <textarea
                                id="behaviorNotes"
                                name="behaviour_notes"
                                placeholder="وصف تفصيلي للسلوك الذي تم رصده (اختياري)..."
                        ></textarea>
                    </div>

                    <button type="submit" class="btn btn-save">حفظ السلوك</button>
                </form>

                <hr style="margin: 2rem 0;">

                <!-- Table: Display Behavior Records -->
                <div class="records-container">
                    <h3 style="margin-bottom: 1rem;">سجل السلوكيات للطالب</h3>
                    <table class="records-table">
                        <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>النوع</th>
                            <th>الملاحظات/الوصف</th>
                            <th>المعلم المُسجِّل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // يجب التأكد من تهيئة $pdo و list_student_behaviours في ملفاتك
                        if (isset($pdo, $_SESSION['student_id'])) {
                            $student_id_session = $_SESSION['student_id'];
                            $behaviour_results = list_student_behaviours($pdo, (int)$student_id_session);
                            print_behaviour_table_rows($behaviour_results);
                        } else {
                            echo '<tr><td colspan="4" style="text-align: center;">يُرجى تسجيل الدخول وعرض بيانات طالب.</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                let analyis_prompt = "بناء علي التقرير المرفق لهذا الطالب قم باعطاء نصائح لمعلم هذا الطالب"
            </script>
            <div id="report" class="tab-content">
                <?php
                $student_id = $_GET['id'];
                require_once $_SERVER['DOCUMENT_ROOT'] . '/marks/student_body.php';
                ?>
            </div>

        </section>
    </main>


    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="/marks/student.js"></script>
    <script src="/assets/scripts/script.js"></script>
    <script src="tabs.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: /login/index.php");
    die();
}
?>
