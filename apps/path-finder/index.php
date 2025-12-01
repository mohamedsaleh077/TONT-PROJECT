<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>
            Path Finder - بوصلة الشغف
        </title>
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

                <div class="right-H1"> مسارات التعليم الثانوي </div>
                <div class="explainText">
                    مسارات التعليم الثانوي قد تبدوا مربكة للبعض , حيث يتم تقسيم الطلاب في الصف الثاني الثانوي إلى شعب علمية وأدبية. يختار الطلاب عادةً بين شعبة علمي علوم التي تركز على المواد العلمية مثل الأحياء والكيمياء، وشعبة علمي رياضيات التي تهتم بالفيزياء والرياضيات، والشعبة الأدبية التي تتناول مواد مثل التاريخ والفلسفة وعلم النفس. غالبًا ما يجد العديد من الطلاب صعوبة في اتخاذ هذا القرار المصيري في سن مبكرة، لأنهم قد لا يكونون على دراية كاملة بميولهم المهنية أو اهتماماتهم المستقبلية، مما قد يؤدي إلى شعورهم بالارتباك والقلق حيال اختيار المسار الأنسب لهم.            </div>

                <div class="right-H1">
                    بوصلة الشغف
                </div>
                <div class="explainText">
                    بوصلة الشغف هي أداة مبتكرة داخل منصة "تونت" لمساعدة الطلاب على اكتشاف المسار التعليمي والمهني الأنسب لهم.
                    <br>
                    كثير من الطلاب يجدون صعوبة في تحديد تخصصهم الجامعي أو مجال عملهم المستقبلي، مما يسبب لهم التشتت والقلق. بوصلة الشغف تُقدم لهم حلًا عمليًا: من خلال مجموعة من الأسئلة المصممة بعناية، تساعد الطالب على التفكير في اهتماماته، مهاراته، وقيمه.
                    <br>
                    تُحلل الإجابات لتُعطي الطالب تقريراً مفصلاً يقترح عليه أفضل التخصصات الأكاديمية والمسارات المهنية التي تتوافق مع شخصيته وشغفه الحقيقي، مما يمنحه الوضوح والثقة لاتخاذ قرارات مهمة لمستقبله.
                </div>



            </div>


            <button class="nextButton" onclick="loadQustions()">srart now</button>

        </main>

        <script src="/assets/scripts/script.js"></script>

        <script src="qustions.js"></script>
        <script src="/assets/scripts/tests/path_finder.js"></script>
    </body>

</html>