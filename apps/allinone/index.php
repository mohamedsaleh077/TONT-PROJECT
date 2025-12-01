<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>المصادر التعليمية - تونت</title>
        <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="main.css">
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

        <!-- Main Content -->
        <div class="container">
            <!-- Evaluation System -->
            <section class="evaluation-section">
                <div class="evaluation-header">
                    <h2 class="section-title"><i class="fas fa-clipboard-check"></i> التقييمات المدرسية المقررة من وزارة التربية والتعليم</h2>
                    <a href="#" class="platform-link">عرض جميع التقييمات</a>
                </div>
                <div class="evaluations-list">
                    <div class="evaluation-item">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">امتحان الرياضيات - الفصل الثالث</h4>
                            <p class="evaluation-meta">مادة: الرياضيات | التاريخ: 2023-10-15</p>
                        </div>
                        <span class="evaluation-status status-completed">مكتمل</span>
                    </div>
                    <div class="evaluation-item">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">تقيم اللغة العربية - النحو</h4>
                            <p class="evaluation-meta">مادة: اللغة العربية | التاريخ: 2023-10-18</p>
                        </div>
                        <span class="evaluation-status status-pending">قيد المراجعة</span>
                    </div>
                    <div class="evaluation-item">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">امتحان العلوم - الوحدة الثانية</h4>
                            <p class="evaluation-meta">مادة: العلوم | التاريخ: 2023-10-20</p>
                        </div>
                        <span class="evaluation-status status-new">جديد</span>
                    </div>
                </div>
            </section>

            <!-- Platforms Section -->
            <section class="platforms-section">
                <h2 class="section-title"><i class="fas fa-layer-group"></i>مكتبة مصادر التعلم المعتمدة من وزارة التربية والتعليم</h2>
                <div class="platforms-grid">

                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/madrasitna.png" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            مدرستنا plus
                        </h3>
                        <p class="platform-description">

                            منصة تعليمية مبتكرة لطلاب مصر. تقدم دروسًا شاملة ومحتوى ترفيهيًّا لإثراء معرفتك ووقتك. تعلم وتألق في مكان واحد!

                        </p>
                        <a href="https://madrasetnaplus.eg" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div>


                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/bawaba.png" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            بوابة التعليم الإلكتروني
                        </h3>
                        <p class="platform-description">
                            هي المصدر الرسمي لوزارة التربية والتعليم. تجد عليها كتب الطالب، المحتوى التفاعلي، مواصفات الورقة الامتحانية، والملخصات لكل المراحل.
                        </p>
                        <a href="https://ellibrary.moe.gov.eg/" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div>


                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/bawaba.png" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            منصة البث المباشر للحصص الافتراضية
                        </h3>
                        <p class="platform-description">
                            نافذتك للقاء المباشر مع معلمي الوزارة الخبراء. تتيح لك حضور حصص افتراضية وتفاعلية لتعويض الدروس المدرسية. جهز أسئلتك!
                        </p>
                        <a href="https://stream.moe.gov.eg/" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div>


                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/hesas.png" style="height: 90px;" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            منصة حصص مصر
                        </h3>
                        <p class="platform-description">
                            المنصة الرسمية للوزارة لطلاب الإعدادي والثانوي. احصل على شرح تفاعلي عالي الجودة، نماذج امتحانات، وبنوك أسئلة، بالإضافة إلى إمكانية التفاعل المباشر مع المعلمين. مستقبلك يبدأ هنا!
                    </p>
                        <a href="https://livestream.moe.gov.eg/login" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div>


                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/bawaba.png" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            منصة تعلم معنا 
                        </h3>
                        <p class="platform-description">
تجربة تعليمية متفردة هي الأولى في الشرق الأوسط! استمتع بـ Personalised Learning وتفاعل مباشر ومحلي مع أشهر المعلمين في محافظتك. تعلم بذكاء، وتواصل بفاعلية!                                               </p>
                        <a href="https://livestream.moe.gov.eg/login" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div>


                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/bawaba.png" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            بنك المعرفة المصري
                        </h3>
                        <p class="platform-description">
                            يعتبر بنك المعرفة المصري أكبر مكتبة رقمية في العالم تقدم مصادراً غير محدودة وحصرياً للمصريين
                        </p>    
                        <a href="https://www.ekb.eg" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div>   


                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/bank.png" alt="مدرستنا بلس" style="height:130px;">
                        </div>
                        <h3 class="platform-title">
                            منصة البحث - بنك المعرفة المصري
                        </h3>
                        <p class="platform-description">
                            فقط قم بإدخال الكلمة المفتاحية عن الموضوع الذي تهتم فيه وسوف تجد كل ما هو يخص هذا المحتوي
                        </p>    
                        <a href="https://www.ekb.eg/web/guest/muse-search" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div> 

                    <div class="platform-card">
                        <div class="platform-icon">
                            <img class="CIMG" src="/../assets/images/cumpanis/nagwa.svg" alt="مدرستنا بلس">
                        </div>
                        <h3 class="platform-title">
                            نجوي
                        </h3>
                        <p class="platform-description">
                            «نجوى» شركة في مجال تكنولوجيا التعليم، تهدف إلى مساعدة المدرسين على التدريس، والطلاب على التعلُّم.
                        </p>    
                        <a href="https://www.nagwa.com" class="platform-link platform-link-bottom" target="_blank">انتقل الان</a>
                    </div> 
                    
                </div>


        </div>

<footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</footer>

<script src="/assets/scripts/script.js"></script>

</body>
</html>