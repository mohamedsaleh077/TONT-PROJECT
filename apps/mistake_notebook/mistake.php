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
            <h1 class="title" id="title">عنوان ملحوظة الخطأ</h1>
            <div class="subjects">
                <input type="text" name="" id="mistake-name" placeholder="Mistake name">
                <input type="text" name="" id="mistake-question" placeholder="the Question ?">
                <input type="text" name="" id="mistake-right-answer" placeholder="the correct answer ?">
                <input type="text" name="" id="mistake-wronge-answer" placeholder="the Wrong answer ?">
                <textarea id="comment" placeholder="you can leave explaination for yourself here..."></textarea>
                <button id="save-mistake">حفظ!</button>
            </div>
        </main>


    <!-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> -->
        <script src="./scripts/actions.js"></script>
        <script src="./scripts/mistake_handler.js"></script>
        
        <script src="/assets/scripts/script.js"></script>
    </body>

</html>