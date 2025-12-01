<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <title>
        Vark Test - ذاكر بطريقتك
    </title>
    <link rel="stylesheet" href="/assets/styles/legacy/main.css">
    <link rel="stylesheet" href="/assets/styles/legacy/mobile.css">
</head>
<body>
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

    <style>
        .exest{
            display: block;
        }
        .NOexest{
            display: none;
        }
    </style>
    <main>
        <div class="theIntro exest">
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
            <button class="nextButton" id="startBuT">ابدأ الان</button>
        </div>

        <div class="theQustionsTimp NOexest">
            <div class="QuestionBlook">
                    <p class="cetered-gray-text" id="qustionNumber">qustionNumber</p>
                    <p class="centered-H1" id="theQustion">thequstion</p>
                    <div class="answers">
                        <div class="answerBlock">
                            <label class="answer-label">
                                <input type="radio" class="yello-circle yello-input" id="V" name="qustionInput" value="V">
                                <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="V" id="answerV">answerV</span>
                            </label>
                        </div>
                        <div class="answerBlock">
                            <label class="answer-label">
                                <input type="radio" class="yello-circle yello-input" id="A" name="qustionInput" value="A">
                                <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="A" id="answerA">answerA</span>
                            </label>
                        </div>
                        <div class="answerBlock">
                            <label class="answer-label">
                                <input type="radio" class="yello-circle yello-input" id="R" name="qustionInput" value="R">
                                <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="R" id="answerR">answerR</span>
                            </label>
                        </div>
                        <div class="answerBlock">
                            <label class="answer-label">
                                <input type="radio" class="yello-circle yello-input" id="K" name="qustionInput" value="K">
                                <span class="custom-radio yello-circle"> </span><span class="TheAnswers" data-value="K" id="answerK">answerK</span>
                            </label>
                        </div>
                    </div>
                </div>  
                <button class="nextButton" id="nextQustionBUT">التالي</button>
        </div>

        <div class="theFinalScreen NOexest">
            <div class="theMain">
                <div class="QuestionBlook">
                    <p class="cetered-gray-text">انتهى الاختبار</p>
                    <p class="centered-H1" id="YourStyle">الاسلوب الامثل لك هو :${YourStyle}</p>
                    <p class="explainText" id="VcountAnownce"> 👁️نسبة انحيازك للاسلوب البصري: ${((Vcount/11)*100).toFixed(2)}%<p>
                    <p class="explainText" id="AcountAnownce"> 🎧نسبة انح  يازك للاسلوب السمعي: ${((Acount/11)*100).toFixed(2)}%<p>
                    <p class="explainText" id="RcountAnownce"> 📖نسبة انحيازك للاسلوب القرائي/الكتابي: ${((Rcount/11)*100).toFixed(2)}%<p>
                    <p class="explainText" id="KcountAnownce"> 🏃‍♂️نسبة انحيازك للاسلوب الحركي: ${((Kcount/11)*100).toFixed(2)}%<p>
                    <p class="explainText"> ✨ استمر في تطوير طريقتك المفضلة، وجرب دمجها مع أساليب أخرى لزيادة الفاعلية.<p>
                    <br>
                    <br>
                </div>
            </div>
            <div class="AIadvice" id="Ai-respond">يتم تحميل نصيحة من Tont-Assestant...</div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="/assets/scripts/script.js"></script>

    <script src="qustions.js"></script>
    <script src="/assets/scripts/tests/vark2.js"></script>
</body>
</html>