<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>
            Vark Test - ذاكر بطريقتك
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

                <div class="right-H1">ما هو اختبار ذاكر بطريقتك؟</div>
                <div class="explainText">
                    اختبار "ذاكر بطريقتك" ليس مجرد اختبار عادي، بل هو بوابة لفهم طبيعة عقلك في استقبال المعلومات. نحن نعتمد
                    بشكل أساسي على نموذج VARK العالمي، وهو اختصار للأنماط الأربعة الرئيسية للتعلم، ولكننا نوسع هذا النموذج
                    ليشمل أدوات واستراتيجيات عملية تناسب كل طالب.
                </div>

                <div class="right-H1">
                    1. استنباط أفضل أسلوب تعلم (VARK والأنماط المكملة)
                </div>
                <div class="explainText">
                    يقوم الاختبار بتحديد أسلوب التعلم المفضل للطالب عبر اختبار VARK:

                    البصري (Visual): هل تتعلم أفضل من خلال الصور، الرسوم البيانية، المخططات، والألوان؟
                    السمعي (Aural): هل يثبت المعلومة في ذهنك بالاستماع إلى الشرح، المناقشة، أو التكرار بصوت عالٍ؟
                    القرائي/الكتابي (Read/Write): هل تفضل القراءة المتعمقة، تدوين الملاحظات بالتفصيل، وإعادة صياغة الأفكار؟
                    الحركي (Kinesthetic): هل تحتاج إلى التجربة العملية، الحركة، أو استخدام اليدين لتثبيت المعلومة (مثل
                    التجارب، أو الألعاب التعليمية التفاعلية)؟
                </div>



            </div>


            <button class="nextButton" onclick="loadQustions()">srart now</button>

        </main>

        <script src="/assets/scripts/script.js"></script>

        <script src="qustions.js"></script>
        <script src="/assets/scripts/tests/vark.js"></script>

    </body>

</html>