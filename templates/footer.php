<div class="footer-content">
    <div class="footer-section">
        <h3>حول منصة تعلّم</h3>
        <p>منصة تعليمية شاملة مصممة لمساعدة الطلاب المصريين على التفوق الأكاديمي من خلال دمج جميع المصادر
            التعليمية الرسمية وتوفير أدوات ذكية للتعلم.</p>
    </div>

    <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="footer-section">
        <h3>ادوات تونت التعليمية</h3>
        <ul class="footer-links">
            <li><a href="/apps/vark2/index.php">ذاكر بطريقتك</a></li>
            <li><a href="/apps/path-finder/index.php">بوصلة الشغف</a></li>
            <li><a href="/apps/mistake_notebook/index.php">كراسة الأخطاء</a></li>
            <li><a href="/apps/notebook/notes/index.php">دفتر الملاحظات</a></li>
            <li><a href="/apps/allinone/index.php">ما تقدمه الوزارة</a></li>
            <li><a href="/apps/ai/index.php">Tont-Assistant</a></li>
        </ul>
    </div>
    <?php } ?>

    <div class="footer-section">
        <h3>تواصل مع الفريق</h3>
        <ul class="footer-links">
            <li><i class="fa-regular fa-envelope"></i> omar.rashed1000@gmail.com</li>
            <li><i class="fa-regular fa-envelope"></i> mohammed.saleh.777@proton.me</li>
            <li><i class="fa-regular fa-envelope"></i> halaosamabary2468@gmail.com</li>
        </ul>
    </div>
</div>

<div class="copyright">
    <p>&copy; Code-Hatsu >\初. جميع الحقوق محفوظة.</p>
</div>