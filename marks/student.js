// NOTE: The API key is kept for the standard Gemini API.
// The AI request will be proxied through tont_ai_proxy.php as requested.
const apiKey = "";

let reportData = null; // سيتم تخزين البيانات المحملة هنا
const dataEndpoint = 'get_student_reports.php'; // نقطة نهاية PHP لبيانات التقارير (Mock)
const aiProxyEndpoint = '/api/ai.php'; // نقطة نهاية PHP المخصصة لمساعد Tont

/**
 * Helper to get the actual value of a CSS variable.
 * @param {string} name - The CSS variable name (e.g., '--success').
 */
function getCssVariable(name) {
    return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
}

/**
 * تحميل بيانات التقرير من الواجهة الخلفية (PHP Mock).
 */
async function loadReportData() {
    // عرض حالة التحميل الأولية
    document.getElementById('studentNameDisplay').querySelector('span').textContent = 'جاري التحميل...';
    document.getElementById('aiTipContent').textContent = 'جاري تحميل البيانات من الخادم...';
    document.getElementById('aiTipButton').disabled = true;

    try {
        // Mock fetch to simulate data loading
        const response = await fetch(dataEndpoint, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        reportData = await response.json();

        if (response.ok) {
            if (reportData.error) {
                throw new Error(reportData.error);
            }
            renderReports(reportData);
        } else {
            throw new Error(`Server returned error: ${reportData.error || response.statusText}`);
        }
    } catch (error) {
        console.error('Failed to load report data:', error);
        const errorMessage = `فشل تحميل البيانات: ${error.message}. يرجى التأكد من تشغيل ملف get_student_reports.php.`;
        document.getElementById('studentNameDisplay').querySelector('span').textContent = 'خطأ في التحميل';
        document.getElementById('aiTipContent').textContent = errorMessage;
    } finally {
        document.getElementById('aiTipButton').disabled = false;
    }
    generateAITip();
}

/**
 * تحديث واجهة المستخدم بالبيانات المحملة.
 * @param {object} data - البيانات المحملة من الخادم.
 */
function renderReports(data) {
    // 1. تحديث اسم الطالب
    document.getElementById('studentNameDisplay').querySelector('span').textContent = data.studentName;

    // استخدام متغيرات CSS للحفاظ على التوافق مع الثيمات
    const successColor = getCssVariable('--success');
    const warningColor = getCssVariable('--accent-yellow');
    const dangerColor = getCssVariable('--danger');

    // 2. تحديث مؤشر المستوى العام
    const percentage = data.overallGrade;
    const radius = 70;
    const circumference = 2 * Math.PI * radius;
    const offset = circumference - (percentage / 100) * circumference;

    const progressFill = document.getElementById('overallProgressFill');
    progressFill.style.strokeDashoffset = offset;

    // تحديث اللون باستخدام متغيرات CSS بدلاً من الألوان الثابتة
    const progressColor = percentage >= 90 ? successColor : percentage >= 80 ? warningColor : dangerColor;
    progressFill.style.setProperty('--progress-color', progressColor);

    document.getElementById('overallPercentage').textContent = `${percentage}%`;

    document.getElementById('totalExamsCount').textContent = data.totalExams;

    // 3. تحديث ميزان السلوك
    const positiveCount = data.behaviour.filter(b => b.type.includes('إيجابي')).length;
    const negativeCount = data.behaviour.filter(b => b.type.includes('سلبي')).length;
    const totalBehavior = positiveCount + negativeCount;
    const positiveRatio = totalBehavior > 0 ? Math.round((positiveCount / totalBehavior) * 100) : 0;

    document.getElementById('positiveCount').textContent = positiveCount;
    document.getElementById('negativeCount').textContent = negativeCount;
    document.getElementById('positiveRatio').textContent = `${positiveRatio}%`;

    const behaviorBar = document.getElementById('behaviorBar');
    behaviorBar.style.width = `${positiveRatio}%`;

    // تحديث لون شريط السلوك باستخدام متغيرات CSS بدلاً من الألوان الثابتة
    const behaviorBarColor = positiveRatio >= 70 ? successColor : positiveRatio >= 50 ? warningColor : dangerColor;
    behaviorBar.style.backgroundColor = behaviorBarColor;

    // 4. ملء جدول الامتحانات
    const examsBody = document.getElementById('examsTableBody');
    examsBody.innerHTML = '';
    if (data.exams.length === 0) {
        examsBody.insertAdjacentHTML('beforeend', '<tr><td colspan="6" class="text-center text-secondary-color p-4">لا توجد سجلات امتحانات حاليًا.</td></tr>');
    } else {
        data.exams.forEach(exam => {
            const markRatio = Math.round((exam.studentMark / exam.fullMark) * 100);
            // استخدام فئات الألوان المخصصة الآن
            let colorClass = markRatio >= 90 ? 'text-success' : markRatio >= 75 ? 'text-warning' : 'text-danger';

            const row = `
                        <tr>
                            <td>${exam.subject}</td>
                            <td>${exam.title}</td>
                            <td>${exam.date}</td>
                            <td class="${colorClass}">${exam.studentMark}</td>
                            <td>${exam.fullMark}</td>
                            <td class="text-bold ${colorClass}">${markRatio}%</td>
                        </tr>
                    `;
            examsBody.insertAdjacentHTML('beforeend', row);
        });
    }


    // 5. ملء جدول السلوك والغياب
    const recordsBody = document.getElementById('recordsTableBody');
    recordsBody.innerHTML = '';

    // دمج سجلات السلوك والغياب والفرز حسب التاريخ
    const allRecords = [...data.behaviour, ...data.absence].sort((a, b) => new Date(b.date) - new Date(a.date));

    if (allRecords.length === 0) {
        recordsBody.insertAdjacentHTML('beforeend', '<tr><td colspan="4" class="text-center text-secondary-color p-4">لا توجد سجلات سلوك أو غياب حاليًا.</td></tr>');
    } else {
        allRecords.forEach(record => {
            let typeClass = record.type.includes('إيجابي') ? 'text-success text-bold' : record.type.includes('سلبي') || record.type.includes('غياب') ? 'text-danger text-bold' : 'text-secondary-color';

            const row = `
                        <tr>
                            <td class="${typeClass}">${record.type.startsWith('غياب') ? record.type : record.type}</td>
                            <td>${record.date}</td>
                            <td>${record.notes}</td>
                            <td>${record.teacher}</td>
                        </tr>
                    `;
            recordsBody.insertAdjacentHTML('beforeend', row);
        });
    }
}

/**
 * استدعاء واجهة Tont Assestant (عبر tont_ai_proxy.php) لتوليد نصيحة مخصصة للطالب
 */
async function generateAITip() {
    if (!reportData) {
        document.getElementById('aiTipContent').textContent = 'يجب تحميل بيانات التقرير أولاً.';
        return;
    }

    const button = document.getElementById('aiTipButton');
    const content = document.getElementById('aiTipContent');

    button.disabled = true;
    button.textContent = 'جاري التحليل...';
    // استخدام class text-primary-color الذي يعكس var(--accent-blue)
    content.innerHTML = '<p class="text-center text-primary-color animate-pulse">يتم تحليل البيانات وإعداد نصيحة مساعد Tont... يرجى الانتظار.</p>';

    const positiveCount = reportData.behaviour.filter(b => b.type.includes('إيجابي')).length;
    const negativeCount = reportData.behaviour.filter(b => b.type.includes('سلبي')).length;
    const overallGrade = reportData.overallGrade;

    // استخراج المواد ذات الأداء المنخفض (أقل من 80%)
    const lowSubjects = reportData.exams
        .filter(e => (e.studentMark / e.fullMark) * 100 < 80)
        .map(e => e.subject)
        .join(', ');

    // بناء البيانات التي سيتم إرسالها إلى الـ Proxy
    console.log(reportData);
    let json_report = JSON.stringify(reportData);
    const requestData = {
        text: analyis_prompt + "\n" + json_report
    };
    console.log('Request Data:', requestData);

    const maxRetries = 3;
    let attempt = 0;

    while (attempt < maxRetries) {
        try {
            // استخدام Exponential Backoff
            if (attempt > 0) {
                const delay = Math.pow(2, attempt) * 1000;
                await new Promise(resolve => setTimeout(resolve, delay));
            }

            const response = await fetch(aiProxyEndpoint, { // استدعاء نقطة النهاية المخصصة
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.text();

            // الواجهة الخلفية (tont_ai_proxy.php) ترجع حقل 'response_text'

            if (result) {
                content.innerHTML = marked.parse(result);
                button.textContent = 'تحليل الأداء وتوليد النصيحة ✨';
                button.disabled = false;
                return;
            } else {
                throw new Error("No advice content received from proxy.");
            }
        } catch (error) {
            console.error('API call failed on attempt', attempt + 1, ':', error);
            attempt++;
            if (attempt >= maxRetries) {
                content.innerText = 'عذرًا، فشل توليد النصيحة بعد عدة محاولات. يرجى مراجعة سجلات الأخطاء والتحقق من ملف tont_ai_proxy.php.';
                button.textContent = 'تحليل الأداء وتوليد النصيحة ✨';
                button.disabled = false;
            }
        }
    }
}

function toggleFullscreen() {
    const card = document.getElementById('reportCard');

    const icon = document.getElementById('fullscreenIcon');
    const content = document.getElementById('aiTipContent');

    card.classList.toggle('card-fullscreen');

    if (card.classList.contains('card-fullscreen')) {
        icon.classList.remove('fa-expand');
        icon.classList.add('fa-compress');
        content.classList.add('ai-tip-content-fullscreen');
    } else {
        icon.classList.remove('fa-compress');
        icon.classList.add('fa-expand');
        content.classList.remove('ai-tip-content-fullscreen');
    }
}

// تشغيل دالة التحميل عند تحميل الصفحة
window.onload = loadReportData;
