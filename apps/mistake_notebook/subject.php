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
            <h1 class="title" id="title">
                <a href="./index.php">المادة</a>
                <button class="edit controls-buttons" onclick="expandAll();">
                    <img id='open-all-img' src="./assets/expand-view-svgrepo-com.svg" alt="edit">
                </button>
            </h1>

            <div class="subjects" id="mistakes-list">



            </div>
            <button id="clear" class="save" onclick="console.log("no");">ازالة الكل</button>
        </main>

        <a id="add-mistake-link" href="./mistake.php?sub=">
            <div class="add-button">+</div>
        </a>
        <button id="clear" class="save" onclick="localStorage.clear(); location.reload();">ازالة الكل</button>

    <!-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> -->
        <script src="./scripts/actions.js"></script>
        <script src="./scripts/mistakes_list.js"></script>
        
        <script src="/assets/scripts/script.js"></script>
    </body>

</html>