<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>

        <link rel="stylesheet" href="/assets/styles/assistant/colors.css">
        <link rel="stylesheet" href="/assets/styles/assistant/main.css">
        <link rel="stylesheet" href="/assets/styles/assistant/phone.css">

        <title>Tont Assistant</title>

        <style>
            body {
                direction: 'ltr';
            }
        </style>
    </head>

    <body>
        <!-- Menu Overlay -->
        <div class="menu-overlay" id="menuOverlay"></div>

        <header>
            <div class="header-container">
                <!-- Menu Toggle Button -->
                <?php $ai_history = true; ?>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head_items.php'; ?>
            </div>
        </header>

        <!-- Navigation Menu (Sidebar) -->
        <nav class="nav-menu" id="navMenu">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/nav.php'; ?>
        </nav>

        <div class="container">


            <!-- history -->
            <aside id="history-container">
                <div class="history-btns">
                    <button class="btn" onclick="newChat();">محادثة جديدة</button>
                    <button class="btn" onclick="ClearAll();">مسح السجل</button>
                </div>

                <div id="history-list">

                </div>
            </aside>


            <!-- chat timeline -->
            <main>
                <div class="welcome-message" id="welcome-message">
                    مرحبا <span class="username"><?= htmlspecialchars ( $_SESSION[ 'fullname' ] ) ?></span>! سعيد بلقائك مجددا
                </div>

            <!-- <input type="text" placeholder="username's chat" class="whoAgain"> -->
                <div id="notify">الاشعارات</div>
                <section class="chat-body" id="chat-body">

                </section>

                <div class="user-input-container">
                    <section class="user-input">
                        <!-- <textarea type="text" id="user-promot"></textarea> -->
                        <div contenteditable="true" id="user-promot" data-placeholder="اسال اي سؤال"></div>

                        <div class="menu-container">
                            <button id="promp" class="promp-button">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <nav class="prompts-menu" id="prompts-menu">
                                <button class="prompt-chip" onclick="promp = 'انت استاذ مصري ملم بالمنهج المصري في كل المواد اسمك هو تونت اسستنت اجاباتك احترافيه وقصيره نسبيا باللغة العربية في اغلب الاحيان  في اغلب الاحيان الا عندما يستلزم الامر اجابه مطوله اكثر اجب عن الاتي بتلك الشخصية:';">الوضع العادي</button>
                                <button class="prompt-chip"
                                        onclick="promp = 'عليك اعراب الجملة التالية اللتي ساكتبها فقط ولا تقم باي شيء اخر '"
                                        ;>اعربلي AI</button>
                                <button class="prompt-chip"
                                        onclick="promp = 'I will give you a sentence in English and I need to fix its grammer with breaking down why you chosen it';">مصحح
                                    الجرامر</button>

                                <button class="prompt-chip"
                                        onclick="promp = ' انت خبير التاريخ الملم بكل ما حدث حسب التاريخ في كتب الدراسة المصرية اجب او اشرح الاتي بدون ان تعرف نفسك من جديد: '"
                                        ;>خبير التاريخ</button>

                                <button class="prompt-chip"
                                        onclick="promp = ' انت المسؤول النفسي في احدى المدارس تعطي نصائح للشباب تحديدا الطلاب اجب عن الاتي دون ان تعرف نفسك من جديد: '"
                                        ;>المسؤول النفسي</button>

                            </nav>
                        </div>

                        <button id="submit">
                            <svg width="40" height="40" viewBox="0 0 20 20" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg" class="icon">
                            <path
                                d="M8.99992 16V6.41407L5.70696 9.70704C5.31643 10.0976 4.68342 10.0976 4.29289 9.70704C3.90237 9.31652 3.90237 8.6835 4.29289 8.29298L9.29289 3.29298L9.36907 3.22462C9.76184 2.90427 10.3408 2.92686 10.707 3.29298L15.707 8.29298L15.7753 8.36915C16.0957 8.76192 16.0731 9.34092 15.707 9.70704C15.3408 10.0732 14.7618 10.0958 14.3691 9.7754L14.2929 9.70704L10.9999 6.41407V16C10.9999 16.5523 10.5522 17 9.99992 17C9.44764 17 8.99992 16.5523 8.99992 16Z">
                            </path>
                            </svg>
                            <!-- <img src="https://cdn-icons-png.flaticon.com/512/60/60525.png" alt=""> -->
                        </button>
                    </section>
                </div>
            </main>

        </div>


    <!-- <script src="history.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script src="/assets/scripts/assistant/actions.js"></script>
        <script src="/assets/scripts/script.js"></script>
        <script src="/assets/scripts/assistant/request.js"></script>
    </body>

</html>