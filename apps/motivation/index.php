<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
       <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
        <title>
        رسائل العزيمة
        </title>
        <style>
            
                    .main-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--purple), var(--pink));
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .page-subtitle {
            opacity: 0.95;
            font-size: 1.1rem;
        }

        .filters-section {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .filters-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .filters-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            background: var(--bg-secondary);
            color: var(--text-secondary);
            border: 2px solid transparent;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            color: var(--accent-blue);
            border-color: var(--accent-blue);
        }

        .filter-btn.active {
            background: var(--accent-blue);
            color: white;
            border-color: var(--accent-blue);
        }

        .messages-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .message-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .message-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
        }

        .message-card.success::before {
            background: var(--success);
        }

        .message-card.motivation::before {
            background: var(--purple);
        }

        .message-card.achievement::before {
            background: var(--accent-yellow);
        }

        .message-card.reminder::before {
            background: var(--accent-blue);
        }

        .message-card.encouragement::before {
            background: var(--pink);
        }

        .message-card.funny::before {
            background: var(--indigo);
        }

        .message-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .message-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
        }

        .message-icon.success {
            background: linear-gradient(135deg, var(--success), #059669);
        }

        .message-icon.motivation {
            background: linear-gradient(135deg, var(--purple), #7c3aed);
        }

        .message-icon.achievement {
            background: linear-gradient(135deg, var(--accent-yellow), var(--warning));
        }

        .message-icon.reminder {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-blue-hover));
        }

        .message-icon.encouragement {
            background: linear-gradient(135deg, var(--pink), #db2777);
        }

        .message-icon.funny {
            background: linear-gradient(135deg, var(--indigo), #4f46e5);
        }

        .message-meta {
            flex: 1;
        }

        .message-type {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.25rem;
        }

        .message-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .message-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            background: var(--bg-secondary);
            color: var(--text-secondary);
        }

        .action-btn:hover {
            background: var(--accent-blue);
            color: white;
        }

        .message-content {
            margin-bottom: 1rem;
        }

        .message-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .message-quote {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--accent-blue);
            font-style: italic;
            text-align: center;
            padding: 1rem;
            background: var(--bg-secondary);
            border-radius: 10px;
            border-right: 4px solid var(--accent-blue);
            margin: 1rem 0;
        }

        .message-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .message-tags {
            display: flex;
            gap: 0.5rem;
        }

        .message-tag {
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .message-reactions {
            display: none;
            align-items: center;
            gap: 1rem;
        }

        .reaction-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.9rem;
        }

        .reaction-btn:hover {
            color: var(--accent-blue);
        }

        .reaction-btn.active {
            color: var(--accent-blue);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-secondary);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .empty-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-desc {
            font-size: 1rem;
        }

        /* Special Random Message */
        .special-message {
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            color: #333;
            border: none;
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.3);
        }

        .special-message::before {
            background: linear-gradient(135deg, #ff8c00, #ff4500);
        }

        .special-message .message-icon {
            background: linear-gradient(135deg, #ff4500, #ff8c00);
        }

        .special-message .message-quote {
            color: #b34700;
            border-right-color: #ff8c00;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-container {
                padding: 0 1rem;
            }

            .nav-main {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .filter-buttons {
                justify-content: center;
            }

            .message-header {
                flex-direction: column;
                text-align: center;
                gap: 0.75rem;
            }

            .message-actions {
                margin-top: 0.5rem;
            }

            .message-footer {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Refresh Button */
        .refresh-container {
            text-align: center;
            margin: 2rem 0;
        }

        .refresh-btn {
            background: linear-gradient(135deg, var(--purple), var(--pink));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        }

        </style>
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
        </nav>    <div class="main-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-fire"></i>
            رسائل العزيمة
        </h1>
        <p class="page-subtitle">رسائل محفزة وملهمة لدعمك في رحلتك التعليمية</p>
    </div>

    <!-- <div class="filters-section">
        <div class="filters-header">
            <h3 class="filters-title">
                <i class="fas fa-filter"></i>
                تصفية الرسائل
            </h3>
        </div>
        <div class="filter-buttons">
            <button class="filter-btn active" onclick="filterMessages('all')">جميع الرسائل</button>
            <button class="filter-btn" onclick="filterMessages('motivation')">تحفيز</button>
            <button class="filter-btn" onclick="filterMessages('achievement')">إنجازات</button>
            <button class="filter-btn" onclick="filterMessages('reminder')">تذكيرات</button>
            <button class="filter-btn" onclick="filterMessages('encouragement')">تشجيع</button>
            <button class="filter-btn" onclick="filterMessages('success')">نجاح</button>
            <button class="filter-btn" onclick="filterMessages('funny')">مرح</button>
        </div>
    </div> -->

    <div class="refresh-container">
        <button class="refresh-btn" onclick="addRandomMessage()">
            <i class="fas fa-sync-alt"></i>
            رسالة عشوائية جديدة
        </button>
    </div>

    <div class="messages-container" id="messagesContainer">
        <!-- الرسائل العادية -->
    </div>
</div>

<script>
    // بيانات الرسائل
    const messages = {
        motivation: [
            {
                type: "motivation",
                icon: "fas fa-fire",
                title: "رسالة تحفيز",
                text: "لا تدع التحديات تثبط عزيمتك. كل خطوة تخطوها نحو تحقيق أهدافك تجعلك أقوى وأكثر خبرة. تذكر أن العظماء لم يصلوا إلى ما وصلوا إليه بسهولة، بل بالمثابرة والإصرار.",
                quote: "النجاح ليس نهاية المطاف، والفشل ليس قاتلاً، ولكن الشجاعة للمتابعة هي ما يهم.",
                tags: ["تحفيز", "إلهام"]
            },
            {
                type: "motivation",
                icon: "fas fa-star",
                title: "دفعة تحفيز",
                text: "كل صفحة تقرأها، وكل مسألة تحلها، وكل درس تتعلمه، يضيف إلى شخصيتك ومعرفتك. أنت تبني مستقبلك بيديك، خطوة بخطوة، يوماً بعد يوم.",
                quote: "التعليم هو السلاح الأقوى الذي يمكنك استخدامه لتغيير العالم",
                tags: ["تحفيز", "تعلم"]
            }
        ],
        success: [
            {
                type: "success",
                icon: "fas fa-trophy",
                title: "تهنئة بالنجاح",
                text: "مبروك! لقد حققت درجة ممتازة في امتحان الرياضيات بنسبة 92%. استمر في هذا الأداء المتميز واجعل هذا النجاح دافعاً لك لتحقيق المزيد من الإنجازات.",
                tags: ["نجاح", "رياضيات"]
            }
        ],
        achievement: [
            {
                type: "achievement",
                icon: "fas fa-medal",
                title: "إنجاز جديد",
                text: "لقد أكملت 15 يوماً متتالياً من الدراسة! هذا الالتزام والانضباط يظهر تفانيك الحقيقي في التعلم. استمر في هذا النمط الإيجابي وستحقق نتائج مذهلة.",
                tags: ["إنجاز", "انضباط"]
            }
        ],
        reminder: [
            {
                type: "reminder",
                icon: "fas fa-clock",
                title: "تذكير ودي",
                text: "لاحظنا أنك لم تدخل المنصة منذ يومين. نذكرك بأن الثبات والانتظام في التعلم هما مفتاح النجاح. عد إلينا وواصل رحلتك التعليمية، نحن هنا لدعمك.",
                tags: ["تذكير", "عودة"]
            }
        ],
        encouragement: [
            {
                type: "encouragement",
                icon: "fas fa-hands-helping",
                title: "رسالة تشجيع",
                text: "نعلم أن الامتحانات قد تكون مرهقة، لكن تذكر أن كل مجهود تبذله الآن هو استثمار في مستقبلك المشرق. أنت أقوى مما تتخيل، ولديك القدرة على تجاوز أي تحدٍ.",
                quote: "الصعوبات هي التي تكشف عن طبيعة الإنسان الحقيقية",
                tags: ["تشجيع", "قوة"]
            }
        ],
        funny: [
            {
                type: "funny",
                icon: "fas fa-laugh-beam",
                title: "رسالة مرح",
                text: "يا حليلك يا بطل! العلم مش زي الأكل، ماينفعش ترميه في الزبالة. خليه في دماغك عشان ينفعك في المستقبل!",
                quote: "الضحك هو أفضل دواء، والتعليم هو أفضل استثمار",
                tags: ["مرح", "ضحك"]
            },
            {
                type: "funny",
                icon: "fas fa-grin-tongue-wink",
                title: "نكتة تعليمية",
                text: "تعرف ليه الطالب المجتهد بيحب الرياضيات؟ عشان مش بيقدر يحسب قد إيه هو تعبان!",
                tags: ["نكتة", "مرح"]
            },
            {
                type: "funny",
                icon: "fas fa-smile-wink",
                title: "كلمة فكاهية",
                text: "لو العقل كان بيتباع في السوق، كان الطلبة المتفوقين بقوا مليارديرات من زمان!",
                quote: "اضحك تضحك لك الدنيا، وادرس تنجح في الحياة",
                tags: ["فكاهة", "تشجيع"]
            }
        ]
    };

    // الرسائل الخاصة العشوائية
    const specialMessages = [
        {
            type: "funny",
            icon: "fas fa-crown",
            title: "رسالة العزيمة الخاصة",
            text: "يا معلم يا باشا! إنت أكيد ابن حلال وأصلك طيب! روح اتعلم واتفوق عشان تبقى زي أبطال مسلسلات رمضان!",
            quote: "اللي بيصعب على التعبان، بيصبح سهل على السلطان",
            tags: ["عزيمة", "تشجيع", "مرح"]
        },
        {
            type: "motivation",
            icon: "fas fa-rocket",
            title: "رسالة تحليق",
            text: "يا طير يا عالي! روح اتعلم واطير بعيد! المستقبل قدامك والدنيا بتناديك!",
            quote: "اللي بيحلم بالنجوم، بيوصل للقمر",
            tags: ["تحليق", "طموح", "نجاح"]
        },
        {
            type: "encouragement",
            icon: "fas fa-heart",
            title: "رسالة حب",
            text: "يا حبيبي يا قلبي! التعليم مش مجرد دراسة، ده استثمار في نفسك! روح اتعلم عشان تبقى أحلى وأذكى!",
            quote: "الحب الحقيقي هو حب التعلم والمعرفة",
            tags: ["حب", "تشجيع", "عاطفة"]
        }
    ];
    // تصفية الرسائل
    function filterMessages(type) {
        // تحديث الأزرار النشطة
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');

        // تصفية الرسائل
        const messageCards = document.querySelectorAll('.message-card');
        messageCards.forEach(card => {
            if (type === 'all' || card.getAttribute('data-type') === type) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // إنشاء رسالة
    function createMessage(messageData, isSpecial = false) {
        const messageCard = document.createElement('div');
        messageCard.className = `message-card ${messageData.type} ${isSpecial ? 'special-message' : ''}`;
        messageCard.setAttribute('data-type', messageData.type);

        let messageHTML = `
            <div class="message-header">
                <div class="message-icon ${messageData.type}">
                    <i class="${messageData.icon}"></i>
                </div>
                <div class="message-meta">
                    <div class="message-type">${messageData.title}</div>
                    <div class="message-time">${getRandomTime()}</div>
                </div>
                <div class="message-actions">
                    <button class="action-btn" onclick="likeMessage(this)"><i class="far fa-heart"></i></button>
                    <button class="action-btn" onclick="shareMessage(this)"><i class="fas fa-share"></i></button>
                </div>
            </div>
            <div class="message-content">
        `;

        if (messageData.quote) {
            messageHTML += `<div class="message-quote">"${messageData.quote}"</div>`;
        }

        messageHTML += `<div class="message-text">${messageData.text}</div></div>`;

        messageHTML += `
            <div class="message-footer">
                <div class="message-tags">
        `;

        messageData.tags.forEach(tag => {
            messageHTML += `<span class="message-tag">${tag}</span>`;
        });

        messageHTML += `
                </div>
                <div class="message-reactions">
                    <button class="reaction-btn" onclick="likeMessage(this)"><i class="far fa-heart"></i> <span>0</span></button>
                    <button class="reaction-btn" onclick="shareMessage(this)"><i class="far fa-smile"></i> <span>0</span></button>
                </div>
            </div>
        `;

        messageCard.innerHTML = messageHTML;
        return messageCard;
    }

    // الحصول على وقت عشوائي
    function getRandomTime() {
        const times = [
            "الآن", "منذ 5 دقائق", "منذ ساعة", "منذ 3 ساعات", 
            "منذ 6 ساعات", "منذ يوم", "منذ يومين", "منذ أسبوع"
        ];
        return times[Math.floor(Math.random() * times.length)];
    }

    // إضافة رسالة عشوائية
    function addRandomMessage() {
        const messagesContainer = document.getElementById('messagesContainer');

        // 20% فرصة لإضافة رسالة خاصة
        const isSpecial = Math.random() < 0.2;

        let messageData;
        if (isSpecial) {
            messageData = specialMessages[Math.floor(Math.random() * specialMessages.length)];
        } else {
            const types = Object.keys(messages);
            const randomType = types[Math.floor(Math.random() * types.length)];
            const typeMessages = messages[randomType];
            messageData = typeMessages[Math.floor(Math.random() * typeMessages.length)];
        }

        const newMessage = createMessage(messageData, isSpecial);
        messagesContainer.prepend(newMessage);
    }

    // تفاعلات الرسائل
    function likeMessage(button) {
        const heartIcon = button.querySelector('i');
        const countSpan = button.querySelector('span');

        if (heartIcon.classList.contains('far')) {
            heartIcon.className = 'fas fa-heart';
            button.classList.add('active');
            countSpan.textContent = parseInt(countSpan.textContent) + 1;
        } else {
            heartIcon.className = 'far fa-heart';
            button.classList.remove('active');
            countSpan.textContent = parseInt(countSpan.textContent) - 1;
        }
    }

    function shareMessage(button) {
        const countSpan = button.querySelector('span');
        countSpan.textContent = parseInt(countSpan.textContent) + 1;

        // تأثير بسيط عند المشاركة
        button.style.transform = 'scale(1.2)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 300);
    }

    // تهيئة الصفحة ببعض الرسائل العشوائية
    window.addEventListener('DOMContentLoaded', () => {
        // إضافة 3-6 رسائل عشوائية عند تحميل الصفحة
        const randomCount = Math.floor(Math.random() * 4) + 3;
        for (let i = 0; i < randomCount; i++) {
            addRandomMessage();
        }
    });
</script>

            <footer>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
        </footer>

        <script src="/assets/scripts/script.js"></script>
    </body>

</html>
