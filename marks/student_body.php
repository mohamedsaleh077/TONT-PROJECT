<!-- محتوى الصفحة الرئيسية -->
<div class="main-container">

    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-chart-line"></i>
            الدرجات والتقارير
        </h1>
        <p id="studentNameDisplay" class="page-subtitle">
            الاسم: <span class="text-bold">جاري التحميل...</span>
        </p>
    </div>

    <!-- Overall Performance and Quick Stats -->
    <div class="dashboard-grid">
        <!-- 1. Overall Grade Progress -->
        <div class="card card-center-items">
            <div class="card-header">
                <div class="card-title">
                    المستوى العام
                    <div class="card-icon"><i class="fas fa-trophy"></i></div>
                </div>
            </div>

            <div class="level-display">
                <div class="level-circle">
                    <svg>
                        <circle cx="75" cy="75" r="70" class="progress-bg"></circle>
                        <circle cx="75" cy="75" r="70" class="progress-fill" id="overallProgressFill"></circle>
                    </svg>
                    <div class="level-text">
                        <div class="level-percentage" id="overallPercentage">--%</div>
                        <div class="level-label">المعدل العام</div>
                    </div>
                </div>
            </div>
            <div class="total-exams-count">
                إجمالي الامتحانات المكتملة: <span id="totalExamsCount">--</span>
            </div>
        </div>

        <!-- 2. Behavior Summary -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    ميزان السلوك
                    <div class="card-icon"><i class="fas fa-balance-scale"></i></div>
                </div>
            </div>
            <div class="behavior-stats-container">
                <div class="stat-item">
                    <div id="positiveCount" class="stat-value text-success">--</div>
                    <div class="stat-label">سلوك إيجابي</div>
                </div>
                <div class="stat-separator"></div>
                <div class="stat-item">
                    <div id="negativeCount" class="stat-value text-danger">--</div>
                    <div class="stat-label">سلوك سلبي</div>
                </div>
            </div>
            <div class="behavior-bar-wrapper">
                <div class="behavior-bar-bg">
                    <div id="behaviorBar" class="behavior-bar-fill"
                         style="width: 0%; background-color: var(--danger);"></div>
                </div>
                <p class="behavior-ratio-text">
                    النسبة الإيجابية: <span id="positiveRatio">--%</span>
                </p>
            </div>
        </div>

        <!-- 3. AI Insights and Tips (Tont Assistant Advice) -->
        <div class="card" id="reportCard">
            <div class="card-header">
                <div class="card-title">
                    نصيحة Tont-assistant
                    <div class="card-icon"><i class="fas fa-lightbulb"></i></div>
                </div>
            </div>
            <button class="btn-fullscreen" onclick="toggleFullscreen()" title="تكبير/تصغير">
                <i class="fas fa-expand" id="fullscreenIcon"></i>
            </button>
            <div class="ai-tip-content-wrapper" id="aiTipContainer">
                <p class="ai-tip-content" id="aiTipContent">
                    اضغط على الزر أدناه لتحليل الأداء بالكامل والحصول على نصيحة مخصصة من الذكاء الاصطناعي.
                </p>
                <button id="aiTipButton" class="btn-ai-tip">
                    تحليل الأداء وتوليد النصيحة ✨
                </button>
            </div>
        </div>
    </div>

    <!-- Detailed Records Section -->

    <!-- Recent Exams Table -->
    <div class="card mt-6">
        <div class="card-header">
            <div class="card-title">
                آخر الامتحانات
                <div class="card-icon"><i class="fas fa-file-alt"></i></div>
            </div>
        </div>

        <div class="responsive-table-container">
            <table class="exams-table">
                <thead>
                <tr>
                    <th>المادة</th>
                    <th>وصف الامتحان</th>
                    <th>التاريخ</th>
                    <th>درجة الطالب</th>
                    <th>الدرجة الكلية</th>
                    <th>النسبة</th>
                </tr>
                </thead>
                <tbody id="examsTableBody">
                <tr>
                    <td colspan="6" class="text-center text-secondary-color p-4">جاري تحميل بيانات الامتحانات...</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Behavior and Absence Records Table -->
    <div class="card mt-6">
        <div class="card-header">
            <div class="card-title">
                سجل السلوك والغياب
                <div class="card-icon"><i class="fas fa-users-cog"></i></div>
            </div>
        </div>

        <div class="responsive-table-container">
            <table class="records-table">
                <thead>
                <tr>
                    <th>النوع</th>
                    <th>التاريخ</th>
                    <th>الملاحظات/الوصف</th>
                    <th>المعلم المُسجِّل</th>
                </tr>
                </thead>
                <tbody id="recordsTableBody">
                <tr>
                    <td colspan="4" class="text-center text-secondary-color p-4">جاري تحميل سجل السلوكيات والغياب...
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>