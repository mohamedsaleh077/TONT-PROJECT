<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>    <title>تونت - البث المباشر</title>
    <link rel="stylesheet" href="./main.css">
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


    <main>
        <div class="stream-page">
            <div class="stream-layout">
                <div class="video-container">
                    <div class="video-player">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/fxXGLMPJnFQ" 
                        title="History of Operating Systems | تاريخ أنظمة التشغيل"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <div class="live-indicator">
                            <i class="fas fa-circle"></i> مباشر
                        </div>
                        <div class="viewer-count">
                            <i class="fas fa-eye"></i> 12,347 مشاهد
                        </div>
                    </div>
                </div>

                <div class="chat-container">
                    <div class="chat-header">
                        <h3 class="chat-title">محادثة البث</h3>
                        <span>12,347 مشاهد</span>
                    </div>
                    <div class="chat-messages">
                        <div class="message">
                            <img src="/apps/dashboard/assets/default.jpg" alt="User" class="user-avatar">
                            <div class="message-content">
                                <span class="username">عبدالرحمن راشد:</span>
                                <span class="message-text">هل يمكنك أن تعيد شرح لماذا كان مالتيكس غير قابل للتوسع؟</span>
                            </div>
                        </div>
                        <div class="message">
                            <img src="/apps/dashboard/assets/default.jpg" alt="User" class="user-avatar">
                            <div class="message-content">
                                <span class="username">عبدالله علي:</span>
                                <span class="message-text"> فيديو كله إفاده</span>
                            </div>
                        </div>
                        <div class="message">
                            <img src="/apps/dashboard/assets/default.jpg" alt="User" class="user-avatar">
                            <div class="message-content">
                                <span class="username">محمد صالح:</span>
                                <span class="message-text">فيديو جميل جدا</span>
                            </div>
                        </div>
                    </div>
                    <div class="chat-input">
                        <input type="text" placeholder="اكتب رسالة هنا...">
                        <button>إرسال</button>
                    </div>
                </div>
            </div>

            <div class="stream-info">
                <div class="info-tabs">
                    <div class="info-tab active" data-tab="about">حول البث</div>
                </div>
                
                <div id="about" class="tab-content active">
                    <div class="about-content">
                        يأخذنا هذا الفيديو في رحلة عبر الزمن لتطور أنظمة التشغيل، بدءًا من الأيام الأولى للحوسبة حيث لم تكن هناك أنظمة تشغيل على الإطلاق، وكان المبرمجون يتعاملون مع الأجهزة مباشرة بلغة الآلة (0 و 1).
                        <br>
                        مع تعقيد الأجهزة، ظهرت الحاجة لبرنامج وسيط لإدارة الموارد، فولدت أنظمة التشغيل الأولى في الخمسينيات، والتي ركزت على جعل استخدام الحاسوب أكثر كفاءة بتشغيل الوظائف في "دفعات" (Batch Processing).
                        <br>

                        كانت الستينيات والسبعينيات فترة ثورية مع ظهور مفاهيم أساسية غيرت عالم الحوسبة إلى الأبد، مثل:
                        <br>

                        الذاكرة الافتراضية
                        <br>

                        تعدد المهام (Multitasking)
                        <br>

                        الأنظمة الزمنية (Time-Sharing) التي سمحت لأكثر من مستخدم باستخدام الحاسوب في نفس الوقت.
                        <br>

                        ثم يتتبع الفيديو الانفجار الكبير في أنظمة التشغيل مع ظهور الحواسيب الشخصية في الثمانينيات، حيث دخلت الأنظمة إلى كل منزل ومكتب، مع منافسة شرسة بين عمالقة مثل:
                        <br>

                        مايكروسوفت (Microsoft) بنظام Windows.
                        <br>

                        أبل (Apple) بنظام Mac OS.
                        <br>

                        لا ينسى الفيديو الإشارة إلى تطور الأنظمة مفتوحة المصدر مثل لينكس (Linux) وتأثيرها الكبير، وصولاً إلى العصر الحديث لأنظمة التشغيل المحمولة مثل أندرويد (Android) و iOS.
                        <br>

                        الخلاصة التي يقدمها الفيديو هي أن تاريخ أنظمة التشغيل هو قصة تطور من تبسيط التعامل مع الأجهزة المعقدة إلى تمكين المستخدم العادي وإنشاء العالم الرقمي المتصل الذي نعيش فيه اليوم.

                    </div>
                </div>
                
            </div>

        </div>
    </main>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
        </footer>

        <script src="/assets/scripts/script.js"></script>


    <script src="main.js"></script>
    <script src="./main.js"></script>

</body>
</html>