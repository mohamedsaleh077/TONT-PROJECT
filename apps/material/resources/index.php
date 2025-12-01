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
                    <h2 class="section-title"><i class="fas fa-clipboard-check"></i> الموارد التعليملة للطالب</h2>
                    <a href="#" class="platform-link"> فلترة <i class="fa-solid fa-filter"></i> </a>
                    <?php if ($_SESSION['user_role'] === 'teacher') { ?>
                    <a href="#" class="platform-link">اضافة <i class="fa-solid fa-plus"></i></a>
                    <?php } ?>
                </div>

                <div class="evaluations-list">


                    <div class="evaluation-item" style="border-left:4px solid var(--success);">
                        <img src="https://sml4.dmu.edu.eg/theme/image.php/academi/core/1758445536/f/pdf?filtericon=1" alt="book" height='50px' style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(88%) contrast(119%);margin-left:20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">الكتاب المدرسي المقرر</h4>
                            <p class="evaluation-meta">مادة: الرياضيات</p>
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">عرض <i class="fa-solid fa-up-right-from-square"></i></span>
                        </a>
                    </div>


                    <div class="evaluation-item" style="border-left:4px solid var(--success);">
                        <img src="https://sml4.dmu.edu.eg/theme/image.php/academi/core/1758445536/f/pdf?filtericon=1" alt="book" height='50px' style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(88%) contrast(119%);margin-left:20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">الكتاب المدرسي المقرر</h4>
                            <p class="evaluation-meta">مادة: الرياضيات</p>
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">عرض <i class="fa-solid fa-up-right-from-square"></i></span>
                        </a>
                    </div>


                    <div class="evaluation-item" style="border-left:4px solid var(--danger);">
                        <img src="https://sml4.dmu.edu.eg/theme/image.php/academi/assign/1758445536/monologo?filtericon=1" alt="book" height='50px' style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(322deg) brightness(88%) contrast(119%);margin-left:20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">test 1</h4>
                            <p class="evaluation-meta">مادة: اللغة العربية | التاريخ: 2025-10-18</p>
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">عرض <i class="fa-solid fa-up-right-from-square"></i></span>
                        </a>
                        
                    </div>
                    <div class="evaluation-item" style="border-left:4px solid var(--danger);">
                        <img src="https://sml4.dmu.edu.eg/theme/image.php/academi/assign/1758445536/monologo?filtericon=1" alt="book" height='50px' style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(322deg) brightness(88%) contrast(119%);margin-left:20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">test 2</h4>
                            <p class="evaluation-meta">مادة: اللغة العربية | التاريخ: 2025-10-18</p>
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">عرض <i class="fa-solid fa-up-right-from-square"></i></span>
                        </a>
                        
                    </div>
                    <div class="evaluation-item" style="border-left:4px solid var(--danger);">
                        <img src="https://sml4.dmu.edu.eg/theme/image.php/academi/assign/1758445536/monologo?filtericon=1" alt="book" height='50px' style="filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(322deg) brightness(88%) contrast(119%);margin-left:20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">test 1</h4>
                            <p class="evaluation-meta">مادة: اللغة الانجليزية | التاريخ: 2025-10-18</p>
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">عرض <i class="fa-solid fa-up-right-from-square"></i></span>
                        </a>
                        

                    </div>
                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="https://i.ytimg.com/vi/eCFjPOQvoN4/hqdefault.jpg?sqp=-oaymwEnCNACELwBSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&amp;rs=AOn4CLDJycHQYg8Yukc6vlHZ2nXa8L0HKQ" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">حصة الرياضيات 13 | اساسيات التفاضل</h4>
                            <p class="evaluation-meta">مادة: الرياضيات | التاريخ: 2023-10-20</p>
                        </div>
                        <a href="https://www.youtube.com/watch?v=eCFjPOQvoN4" style="text-decoration: none" target="_blank">
                            <span class="evaluation-status status-new">مشاهدة<i class="fa-solid fa-caret-left"></i></span>
                        </a>
                    </div>

                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="https://i.ytimg.com/vi/tHnndv9K3AQ/hqdefault.jpg?sqp=-oaymwEnCNACELwBSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLCLr11PSB1UkosYR-VNN__CPi8tJA" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">حصة الرياضيات 14 | قوانين التفاضل</h4>
                            <p class="evaluation-meta">مادة: الرياضيات | التاريخ: 2023-10-20</p>
                        </div>
                        <a href="https://www.youtube.com/watch?v=tHnndv9K3AQ" style="text-decoration: none" target="_blank">
                            <span class="evaluation-status status-new">مشاهدة<i class="fa-solid fa-caret-left"></i></span>
                        </a>
                    </div>

                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="https://i.ytimg.com/vi/Q_aS4AJ8gYc/hqdefault.jpg?sqp=-oaymwFBCNACELwBSFryq4qpAzMIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB8AEB-AH-CYAC0AWKAgwIABABGGUgTyhIMA8=&rs=AOn4CLAWQUxMfR4NLkpCeXdMqH59kXJeRA" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">حصة التاريخ 5 | تاريخ الخلافة الاسلامية</h4>
                            <p class="evaluation-meta">مادة: التاريخ | التاريخ: 2023-10-20</p>
                        </div>
                        <a href="https://www.youtube.com/watch?v=Q_aS4AJ8gYc" style="text-decoration: none" target="_blank">
                            <span class="evaluation-status status-new">مشاهدة<i class="fa-solid fa-caret-left"></i></span>
                        </a>
                    </div>
                </div>
            </section>


        </div>

<footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</footer>

<script src="/assets/scripts/script.js"></script>

</body>
</html>