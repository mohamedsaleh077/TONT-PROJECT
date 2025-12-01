// الانتظار حتى يتم تحميل DOM بالكامل
document.addEventListener('DOMContentLoaded', function() {
    // عناصر DOM المطلوبة
    const gradeSelect = document.getElementById('grade-select');
    const nameInput = document.querySelector('input[placeholder="اسم الطالب"]');
    const codeInput = document.querySelector('input[placeholder="كود الطالب"]');
    const searchBtn = document.querySelector('.search-btn');
    const tableRows = document.querySelectorAll('.school-table tbody tr');
    
    // دالة للبحث وفلترة الطلاب
    function filterStudents() {
        // الحصول على قيم البحث
        const selectedGrade = gradeSelect.value;
        const nameQuery = nameInput.value.trim().toLowerCase();
        const codeQuery = codeInput.value.trim().toLowerCase();
        
        // تكرار على جميع الصفوف في الجدول
        tableRows.forEach(row => {
            // الحصول على بيانات الصف
            const codeCell = row.cells[0].textContent.trim().toLowerCase();
            const nameCell = row.cells[1].textContent.trim().toLowerCase();
            const gradeCell = row.cells[2].textContent.trim();
            
            // التحقق من تطابق معايير البحث
            const gradeMatch = !selectedGrade || 
                (selectedGrade === 'first_preparatory' && gradeCell.includes('7')) ||
                (selectedGrade === 'second_preparatory' && gradeCell.includes('8')) ||
                (selectedGrade === 'third_preparatory' && gradeCell.includes('9')) ||
                (selectedGrade === 'first_primary' && gradeCell.includes('1')) ||
                (selectedGrade === 'second_primary' && gradeCell.includes('2')) ||
                (selectedGrade === 'third_primary' && gradeCell.includes('3')) ||
                (selectedGrade === 'fourth_primary' && gradeCell.includes('4')) ||
                (selectedGrade === 'fifth_primary' && gradeCell.includes('5')) ||
                (selectedGrade === 'sixth_primary' && gradeCell.includes('6')) ||
                (selectedGrade === 'first_secondary' && gradeCell.includes('10')) ||
                (selectedGrade === 'second_secondary' && gradeCell.includes('11')) ||
                (selectedGrade === 'third_secondary' && gradeCell.includes('12'));
                
            const nameMatch = !nameQuery || nameCell.includes(nameQuery);
            const codeMatch = !codeQuery || codeCell.includes(codeQuery);
            
            // إظهار أو إخفاء الصفوف بناءً على النتائج
            if (gradeMatch && nameMatch && codeMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // إضافة مستمعي الأحداث
    searchBtn.addEventListener('click', filterStudents);
    
    // البحث عند الضغط على Enter في أي من حقول الإدخال
    [nameInput, codeInput].forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                filterStudents();
            }
        });
    });
    
    // فلترة تلقائية عند تغيير اختيار الصف
    gradeSelect.addEventListener('change', filterStudents);
});