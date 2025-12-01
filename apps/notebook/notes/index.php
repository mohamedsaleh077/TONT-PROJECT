<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>النوتة</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="mobile.css">
        
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

        <!-- Page Content -->
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-sticky-note"></i>
                    الملاحظات
                </h1>
                <div class="actions">
                    <!-- <button class="btn btn-outline">
                      <i class="fas fa-filter"></i>
                      Filter
                    </button>
                    <button class="btn btn-outline">
                      <i class="fas fa-sort"></i>
                      Sort
                    </button> -->
                    <a href="../editor/index.php">
                        <button class="btn btn-primary">

                            <i class="fas fa-plus"></i>
                            ملاحظه جديدة

                        </button>
                    </a>
                </div>
            </div>

            <div class="notes-grid" id="notes-grid">



            </div>

        </div>
        <a href="../editor/index.php">
            <div class="fab">

                <i class="fas fa-plus"></i>

            </div>
        </a>

        <script src="script.js"></script>
        <script src="../logic/print.js"></script>
        
        <script src="/assets/scripts/script.js"></script>

    </body>

</html>