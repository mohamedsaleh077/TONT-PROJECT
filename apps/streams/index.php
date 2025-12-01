<?php
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/get_all_info.inc.model.php" ;
    if ( !isset($_SESSION['user_id']) ) {
        header("Location: /login/index.php");
        die();
    }
    $user_id = $_SESSION[ 'ref_id' ] ;
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <link rel="stylesheet" href="/apps/dashboard/main.css">
    <link rel="stylesheet" href="main.css"/>
    <title>تونت - منصة البث المباشر</title>
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

    <main style="margin-top: 40px">
        <div class="stream-container">
            <!-- Sidebar -->
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aside.php'; ?>

            <!-- Main Content -->
            <section class="stream-main">
                <section class="stream-section">
                    <div class="section-header">
                        <h2 class="section-title">البثوث المباشرة</h2>
                        <a href="#" class="view-all">عرض الكل <i class="fas fa-chevron-left"></i></a>
                    </div>
                    <div class="stream-grid">
                        
                        <a href="video/index.php">
                        <div class="stream-card">
                            <div class="stream-thumbnail">
                                <img src="/assets/images/placeholder.png" alt="Math Stream">
                                <div class="live-badge">
                                    <i class="fas fa-circle"></i> مباشر
                                </div>
                                <div class="viewer-count">
                                    <i class="fas fa-eye"></i> 243
                                </div>
                            </div>
                            <div class="stream-info">
                                <h3 class="stream-title">حساب التفاضل والتكامل: تقنيات التكامل</h3>
                                <div class="stream-meta">
                                    <img src="/apps/dashboard/assets/default.jpg" alt="Professor" class="streamer-avatar">
                                    <span>د. وليامز</span>
                                    <span>• الرياضيات</span>
                                </div>
                            </div>
                        </div>
                        </a>

                        <a href="video/index.php">
                        <div class="stream-card">
                            <div class="stream-thumbnail">
                                <img src="/assets/images/placeholder.png" alt="Physics Stream">
                                <div class="live-badge">
                                    <i class="fas fa-circle"></i> مباشر
                                </div>
                                <div class="viewer-count">
                                    <i class="fas fa-eye"></i> 187
                                </div>
                            </div>
                            <div class="stream-info">
                                <h3 class="stream-title">معمل الفيزياء: الموجات الكهرومغناطيسية</h3>
                                <div class="stream-meta">
                                    <img src="/apps/dashboard/assets/default.jpg" alt="Professor" class="streamer-avatar">
                                    <span>أ. شين</span>
                                    <span>• الفيزياء</span>
                                </div>
                            </div>
                        </div>
                        </a>

                        <a href="video/index.php">
                        <div class="stream-card">
                            <div class="stream-thumbnail">
                                <img src="/assets/images/placeholder.png" alt="Literature Stream">
                                <div class="live-badge">
                                    <i class="fas fa-circle"></i> مباشر
                                </div>
                                <div class="viewer-count">
                                    <i class="fas fa-eye"></i> 156
                                </div>
                            </div>
                            <div class="stream-info">
                                <h3 class="stream-title">ماكبث لشكسبير: تحليل ومناقشة</h3>
                                <div class="stream-meta">
                                    <img src="/apps/dashboard/assets/default.jpg" alt="Professor" class="streamer-avatar">
                                    <span>د. إيفانز</span>
                                    <span>• الأدب</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </section>
                
                <section class="stream-section">
                    <div class="section-header">
                        <h2 class="section-title">البثوث القادمة</h2>
                        <a href="#" class="view-all">عرض الكل <i class="fas fa-chevron-left"></i></a>
                    </div>
                    <div class="stream-grid">
                        <div class="upcoming-card">
                            <div class="upcoming-time">
                                <div class="upcoming-day">15</div>
                                <div class="upcoming-month">أكتوبر</div>
                            </div>
                            <div class="upcoming-info">
                                <h3 class="upcoming-title">الكيمياء: المركبات العضوية</h3>
                                <p class="upcoming-desc">2:00 مساءً - 3:30 مساءً</p>
                                <button class="reminder-btn">تعيين تذكير</button>
                            </div>
                        </div>

                        <div class="upcoming-card">
                            <div class="upcoming-time">
                                <div class="upcoming-day">17</div>
                                <div class="upcoming-month">أكتوبر</div>
                            </div>
                            <div class="upcoming-info">
                                <h3 class="upcoming-title">التاريخ: الحرب العالمية الثانية</h3>
                                <p class="upcoming-desc">11:00 صباحاً - 12:30 ظهراً</p>
                                <button class="reminder-btn">تعيين تذكير</button>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="stream-section">
                    <div class="section-header">
                        <h2 class="section-title">البثوث المسجلة</h2>
                        <a href="#" class="view-all">عرض الكل <i class="fas fa-chevron-left"></i></a>
                    </div>
                    <div class="stream-grid">
                        
                        <a href="video/index.php">
                        <div class="stream-card">
                            <div class="stream-thumbnail">
                                <img src="/assets/images/placeholder.png" alt="Biology Stream">
                                <div class="viewer-count">
                                    <i class="fas fa-play-circle"></i> 1.2K
                                </div>
                            </div>
                            <div class="stream-info">
                                <h3 class="stream-title">الأحياء: تركيب ووظيفة الخلية</h3>
                                <div class="stream-meta">
                                    <img src="/apps/dashboard/assets/default.jpg" alt="Professor" class="streamer-avatar">
                                    <span>د. ميلر</span>
                                    <span>• منذ 3 أيام</span>
                                </div>
                            </div>
                        </div>
                        </a>

                        <a href="video/index.php">
                        <div class="stream-card">
                            <div class="stream-thumbnail">
                                <img src="https://i.ytimg.com/vi/fxXGLMPJnFQ/hqdefault.jpg?sqp=-oaymwEcCNACELwBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLCzy2jYepsG38vPSqTVS0l662lLCw" alt="CS Stream">
                                <div class="viewer-count">
                                    <i class="fas fa-play-circle"></i> 2.4K
                                </div>
                            </div>
                            <div class="stream-info">
                                <h3 class="stream-title">
                                    History of Operating systems
                                </h3>
                                <div class="stream-meta">
                                    <img src="/apps/dashboard/assets/default.jpg" alt="Professor" class="streamer-avatar">
                                    <span>Ahmed Al-Hussine</span>
                                    <span>• منذ أسبوع</span>
                                </div>
                            </div>
                        </div>
                        </a>
                        
                        <a href="video/index.php">
                        <div class="stream-card">
                            <div class="stream-thumbnail">
                                <img src="/assets/images/placeholder.png" alt="Art Stream">
                                <div class="viewer-count">
                                    <i class="fas fa-play-circle"></i> 897
                                </div>
                            </div>
                            <div class="stream-info">
                                <h3 class="stream-title">فن عصر النهضة: التقنيات والرواد</h3>
                                <div class="stream-meta">
                                    <img src="/apps/dashboard/assets/default.jpg" alt="Professor" class="streamer-avatar">
                                    <span>د. روبرتس</span>
                                    <span>• منذ أسبوعين</span>
                                </div>
                            </div>
                        </div>
                        </a>
                        
                    </div>
                </section>
            </section>
            
        </div>
    </main>

    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
    </footer>

    <script src="/assets/scripts/script.js"></script>

</body>
</html>