<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        
        <link rel="stylesheet" href="styles/main.css"/>
        <link rel="stylesheet" href="styles/colors.css"/>
        <link rel="stylesheet" href="styles/phone.css"/>
        <title>
            Mistake Notebook - كراسة الأخطاء
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
            <h1 class="title">كراسة الأخطاء</h1>
            <div class="subjects">
                <div id="subject-list">


                </div>
                <div class="subject-name create-subject" id="create-subject">
                    <input class="subject-name-input" type="text" id="subect-name" placeholder="Type Subject Name Here">
                    <button class="save" id="save-subject">حفظ</button>
                    <!-- <button class="save" id="change-subject">change</button> -->
                </div>
                <button id="clear" class="save" onclick="localStorage.clear(); location.reload();">clear</button>

        </main>

        <div class="add-button" id="add-subject">+</div>
        <!-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> -->
        <script src="./scripts/actions.js"></script>
        <script src="./scripts/subject_handler.js"></script>

        <script src="/assets/scripts/script.js"></script>

    </body>

</html>