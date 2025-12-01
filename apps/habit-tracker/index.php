<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <link rel="stylesheet" href="main.css"/>
        <title>
            منشيء العادات
        </title>
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
        <section class="right">
            <section class="hero">
                <p class="member-job" style="text-align: center;">
                    تتبع عاداتك السيئة وابدأ رحلة الإقلاع عنها
                </p>
            </section>


            <!-- Habit Tracker Section -->
            <div class="tab-content active" id="habits-tab">
                <div class="habit-section">
                    <div class="habit-form-container">
                        <div class="habit-form-row">
                            <div class="habit-form-group">
                                <label for="habitInput">اسم العادة السيئة</label>
                                <input type="text" id="habitInput" placeholder="أدخل اسم العادة السيئة"
                                    class="habit-input">
                            </div>
                            <div class="habit-form-group" style="display: flex; align-items: flex-end;">
                                <button class="add-habit-btn">إضافة العادة</button>
                            </div>
                        </div>
                    </div>

                    <div class="habits-list" id="habitsList">
                        <!-- Habits will be dynamically added here -->
                    </div>
                </div>
            </div>
        </section>
                <section class="left badge">
            <p>All Badges</p>
            <div class="badgeBlock">
                <img src="https://pbs.twimg.com/media/FCkYRUXXMA0Wld6.jpg" height="20px" width="20px">
                <div class="badgeBlockText">
                    <p>yes chad</p>
                    <p>0+ days</p>
                </div>
            </div>
            <div class="badgeBlock">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWD38CENmBY98tXFcVj9XN5V36bpIU5XoBsg&s"
                    height="20px" width="20px">
                <div class="badgeBlockText">
                    <p>average</p>
                    <p>0+ days</p>
                </div>
            </div>
            <div class="badgeBlock">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0NUSBurc7IWw0S94Jzpecrz8Mabswj81Bw41WsuhPZwEz8MT02x5c-RJskxqh5gGbWcY&usqp=CAU"
                    height="20px" width="20px">
                <div class="badgeBlockText">
                    <p>chad</p>
                    <p>5+ days</p>
                </div>
            </div>
            <div class="badgeBlock">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_PFR95IMHjrbDknyB-qoRfp-xSya5g7x5sw&s"
                    height="20px" width="20px">
                <div class="badgeBlockText">
                    <p>sigme</p>
                    <p>10+ days</p>
                </div>
            </div>
            <div class="badgeBlock">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQj962BRP5IMX79KaGWOSybEKEEZmzEIKiljg&s"
                    height="20px" width="20px">
                <div class="badgeBlockText">
                    <p>giga chad</p>
                    <p>0+ days</p>
                </div>
            </div>

        </section>
    </main>

        

           <script src="/assets/scripts/script.js"></script>

            <script src="main.js"></script>
</body>

</html>