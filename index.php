<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php"; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <?php require_once __DIR__ . '/templates/head.php'; ?>
        <link rel="stylesheet" href="assets/styles/home/main.css">
        <title>تونت - منصة التعليم الشاملة للطلاب المصريين</title>
    </head>

    <body>
        <!-- Menu Overlay --> 
        <div class="menu-overlay" id="menuOverlay"></div>

        <header>
            <div class="header-container">
                <!-- Menu Toggle Button -->
                <?php require_once __DIR__ . '/templates/head_items.php'; ?>
            </div>
        </header>

        <!-- Navigation Menu (Sidebar) -->
        <nav class="nav-menu" id="navMenu">
            <?php require_once __DIR__ . '/templates/nav.php'; ?>
        </nav>

        <main>
            <section class="hero intro">

                <h1 class="hero-title" style="margin-top: 136px">مرحبا بكم في تونت <i class="fas fa-graduation-cap"></i> </h1>
                <h1 class="hero-title" style="margin-top: 6px;margin-bottom: 121px;"    >
                    مسارك نحو <span class="highlight">التعلم الذكي</span> يبدأ من هنا
                    <?php if (!isset($_SESSION['user_id'])) {?>

                <p class="member-job" style="text-align: center;">
                    أهلاً بكم في بيئة التعلم الذكية التي صُممت خصيصاً لتجعل رحلتكم التعليمية أكثر سهولة وتركيزاً
                </p>

                <a href="/get_account/index.php" class="btn-register">ابدأ الآن</a>
                    <?php } ?>
                </h1>

                <div class="intro-divs">
                    <div class="section intro-card">
                        <h2>بيئة تعلم ذكية</h2>
                        <p class="member-job">صممنا "تونت" لتكون منصتكم التعليمية الذكية، حيث تجدون كل ما تحتاجونه من أدوات
                            وتنظيم في مكان واحد، لتجعلوا رحلتكم التعليمية أسهل وأكثر فاعلية.</p>
                    </div>

                    <div class="section intro-card">
                        <h2>ما الذي نقدمه؟</h2>
                        <p class="member-job">نمنحكم تجربة تعليمية مخصصة، تشمل: خطط دراسية ذكية، أدوات تنظيم وقت، انتقال سلس
                            بين الدروس، وموارد متعددة تعزز من فهمكم وتركز على أهدافكم الشخصية.</p>
                    </div>

                    <div class="section intro-card">
                        <h2>لمن هذه المنصة؟</h2>
                        <p class="member-job">تم تصميم "تونت" لتخدم الطلاب، أولياء الأمور، والمعلمين على حدٍ سواء، مما يخلق
                            بيئة تعليمية متكاملة وتفاعلية تعزز من التواصل والتعاون بين جميع الأطراف.</p>
                    </div>

                    <div class="section intro-card">
                        <h2>مستقبلك يبدأ من هنا</h2>
                        <p class="member-job">نحن هنا لمساعدتكم على الانطلاق في مسار تعلم يناسب أسلوبكم الفردي ويقودكم نحو
                            التميز، في إطار بيئة تعليمية محفّزة وملهمة.</p>
                    </div>
                </div>

                
            <!-- <p>
                أهلاً بكم في بيئة التعلم الذكية التي صُممت خصيصاً لتجعل رحلتكم التعليمية أكثر سهولة وتركيزاً<br> -->

                <!-- لقد أمضينا وقتاً طويلاً في الاستماع إليكم، واليوم نقدم لكم الحل الشامل الذي يجمع كل ما تحتاجونه في مكان
                    واحد<br> -->

                <!-- في تونت، ستجدون مساركم التعليمي الخاص بكم، وخططاً دراسية مخصصة، وأدوات تنظيم -->
                <!-- الوقت، وكل ما يلزمكم لتحويل التحديات إلى فرص. -->
                <!-- <br> -->
                <!-- نحن هنا لمساعدتكم على تحقيق أقصى إمكاناتكم، والانتقال من التشتت إلى التركيز. -->
                <!-- <br>
                    انضموا إلينا لنصنع معاً مستقبلاً تعليمياً أكثر إشراقاً!
                    <br> -->
                <!-- وتتمثل رؤيتنا في تمكين كل طالب مصري من الوصول إلى تجربة تعليمية مخصصة ومدمجة،
                    حيث يصبح التعلم رحلة سلسة وممتعة تساعده على تحقيق أقصى إمكاناته، وتُعده لمستقبله بوعي وثقة.
                    <br> -->
                <!-- و نحن نسعى في تونت إلى بناء منصة تعليمية شاملة تجمع بين أدوات تنظيم الوقت،
                    وتحفيز العادات الإيجابية، والمصادر التعليمية المتعددة في مكان واحد. نقدم لكل طالب مسارًا
                    تعليميًا فريدًا يناسب أسلوب تعلمه الفردي، ونعمل على تعزيز التواصل الفعال بين جميع أطراف المنظومة
                    <br> -->
                <!-- التعليمية (الطلاب، المعلمين، وأولياء الأمور) لخلق بيئة دراسية متكاملة ومنتجة. هدفنا هو تحويل التحديات التعليمية الحالية إلى فرص للنمو والنجاح المستمر. -->
                <!-- </p> -->





<!--                <div class="hero-search">
                    <input type="text" class="search-input" placeholder="find school server">
                    <button class="btn-find">Login</button>
                </div>-->
            </section>

            <section class="features">
                <div class="features-header">
                    <h2 class="features-title">كل ما تحتاجه في مكان واحد</h2>
                    <p class="features-subtitle">
                        منصة متكاملة تضم جميع الأدوات والمصادر التي تحتاجها لتحقيق التفوق الأكاديمي
                    </p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 class="feature-title">تنظيم الدراسة ومتابعة المستوى</h3>
                        <p class="feature-desc">
                            تنظيم جدوله المدرسي ,تسجيل كل التقييمات المدرسية ومتابعة مدى تحسن أو تدهور مستواه
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-spell-check"></i>
                        </div>
                        <h3 class="feature-title">اختبار "ذاكِر بطريقتك"</h3>
                        <p class="feature-desc">استنباط أفضل أسلوب تعلم لكل طالب بشكل فردي</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open-reader"></i>
                        </div>
                        <h3 class="feature-title">كراسة الاخطاء</h3>
                        <p class="feature-desc">اكتشف أسلوب تعلمك وحدد مسارك الأكاديمي مع توثيق مع كل اختبار الاسئلة التي
                            أخطأ في اجابتها الطالب</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-people-group"></i>
                        </div>
                        <h3 class="feature-title">مجتمع تعليمي</h3>
                        <p class="feature-desc">تفاعل مع زملائك والمعلمين واطرح أسئلتك واحصل على إجابات من الخبراء</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3 class="feature-title">متابعة المستوي</h3>
                        <p class="feature-desc">يمكن طالب والمعلم و ولي الأمر الإطلاع علي معلومات متابعة المستوي من خلال طرق
                            تسجيل البيانات المختلفة: النسب المئوية , مخططات التدفق وغيرها.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h3 class="feature-title">“مُنشِئ العادات الجديدة”</h3>
                        <p class="feature-desc">اداة لمساعدة الطالب علي التخلص من كل العادات السيئة وبناء عادات جديدة جيدة.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="feature-title">رسائل العزيمة</h3>
                        <p class="feature-desc">سيتلقى الطالب رسائل تحفيزية حيثما التقط النظام هبوط مألوف للدرجات والمشاركة
                            في أنشطة الفصل</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="feature-title">قائمة المتصدرين</h3>
                        <p class="feature-desc">تتم إضافة قائمة للمتصدرين في الدراسة وإتمام المهام على مستوى الفصل لتشجيع
                            الطلاب علي الانضباط ورفع روح المنافسة.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3 class="feature-title">Tont-Assistant</h3>
                        <p class="feature-desc">مساعد دردشة ذكي لمساعدة الطالب علي الدراسة وشرح النقاط الصعبة وتنظيم عملية
                            استرجاع ما تم تعلمه وتنظيم الوقت والتجهيز للاختبارات النهائية بالمساعدة في المراجعة.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-compass"></i>
                        </div>
                        <h3 class="feature-title">بوصلة الشغف</h3>
                        <p class="feature-desc">أداة لمساعدة الطالب لدراسه افضل شعبة/مجال/مسار/جامعة/مهنة وخلافه من خلال
                            أسئلة تساعده على العصف الذهني وتقرير ما هو الهدف الذي يستحق أن يسعى إليه ومن خلالها سيتمكن
                            الطالب من تحديد هدفه ويمضي قدمًا لتحقيقه</p>
                    </div>
                </div>


            </section>

        </main>

        <footer>
            <?php require_once __DIR__ . '/templates/footer.php'; ?>
        </footer>

        <script src="/assets/scripts/script.js"></script>
    </body>

</html>