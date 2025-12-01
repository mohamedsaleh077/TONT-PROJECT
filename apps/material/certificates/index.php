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












        <div class="container">
            <section class="evaluation-section">
                <div class="evaluation-header">
                    <h2 class="section-title" style="margin-bottom: -22px;"><i class="fas fa-clipboard-check"></i> جدول الدرجات النهائية</h2>
                    <!-- <a href="#" class="platform-link"> فلترة <i class="fa-solid fa-filter"></i> </a> -->
                    <!-- <a href="#" class="platform-link">اضافة <i class="fa-solid fa-plus"></i></a> -->
                </div>


                <table>
                    <tr>
                        <th>المادة</th>
                        <th>درجة الطالب</th>
                        <th>النهاية العظمى</th>
                        <th>النهاية الصغرة</th>
                    </tr>
                    <tr>
                        <td>اللغة العربية</td>
                        <td>68.5</td>
                        <td>80</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>اللغة الانجليزية</td>
                        <td>53</td>
                        <td>60</td>
                        <td>30</td>

                    </tr>
                    <tr>
                        <td>الرياضيات</td>
                        <td>56</td>
                        <td>60</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>الكيمياء</td>
                        <td>54</td>
                        <td>60</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>الفيزياء</td>
                        <td>60</td>
                        <td>60</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>الاحياء</td>
                        <td>غير مقرر</td>
                        <td>60</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>التاريخ</td>
                        <td>غير مقرر</td>
                        <td>60</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>الجغرافيا</td>
                        <td>غير مقرر</td>
                        <td>60</td>
                        <td>30</td>
                    </tr>
                </table>
            </section>
        </div>

        <!-- Main Content -->
        <div class="container">
            <!-- Evaluation System -->
            <section class="evaluation-section">
                <div class="evaluation-header">
                    <h2 class="section-title"><i class="fas fa-clipboard-check"></i> الموارد التعليملة للطالب</h2>
                    <a href="#" class="platform-link"> فلترة <i class="fa-solid fa-filter"></i> </a>
                    <!-- <a href="#" class="platform-link">اضافة <i class="fa-solid fa-plus"></i></a> -->
                </div>

                <div class="evaluations-list">

                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="certificates/javaScript-101.png" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">شهادة 1</h4>
                            <!-- <p class="evaluation-meta">مادة: اللغة العربية | التاريخ: 2025-10-18</p> -->
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">تحميل <i class="fa-solid fa-download"></i></span>
                        </a>
                        <!-- <span class="evaluation-status status-completed" style="background:var(--danger);margin-right:10px;"> رفع<i class="fa-solid fa-upload"></i></span> -->
                    </div>
                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="certificates/digitopia2.png" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">شهادة 2</h4>
                            <!-- <p class="evaluation-meta">مادة: اللغة الانجليزية | التاريخ: 2025-10-18</p> -->
                        </div>
                        <a  style="text-decoration: none" target="_blank" href="https://elearnningcontent.blob.core.windows.net/elearnningcontent/2026/Primary/Primary6/Term1/StudentBook/Math_Ar_prim6_TR1.pdf" download="الرياضيات كتاب الطالب">
                            <span class="evaluation-status status-completed">تحميل <i class="fa-solid fa-download"></i></span>
                        </a>
                        <!-- <span class="evaluation-status status-completed" style="background:var(--danger);margin-right:10px;"> رفع<i class="fa-solid fa-upload"></i></span> -->

                    </div>
                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="certificates/digitopia1.png" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">شهادة 3</h4>
                            <!-- <p class="evaluation-meta">مادة: الرياضيات | التاريخ: 2023-10-20</p> -->
                        </div>
                        <span class="evaluation-status status-completed">تحميل <i class="fa-solid fa-download"></i></span>
                    </div>

                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="certificates/Bootstrap.png" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">شهادة 4</h4>
                            <!-- <p class="evaluation-meta">مادة: الرياضيات | التاريخ: 2023-10-20</p> -->
                        </div>
                        <span class="evaluation-status status-completed">تحميل <i class="fa-solid fa-download"></i></span>
                    </div>

                    <div class="evaluation-item" style="border-left:4px solid var(--color-accent-blue);">
                        <img src="certificates/DOM.png" alt="book" height="75px" style="margin-left: 20px;">
                        <div class="evaluation-info">
                            <h4 class="evaluation-title">شهادة 5</h4>
                            <!-- <p class="evaluation-meta">مادة: التاريخ | التاريخ: 2023-10-20</p> -->
                        </div>
                        <span class="evaluation-status status-completed">تحميل <i class="fa-solid fa-download"></i></span>
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