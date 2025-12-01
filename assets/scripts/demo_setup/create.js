// Role-based form fields
const roleSelect = document.getElementById('role');
const studentFields = document.getElementById('studentFields');
const teacherFields = document.getElementById('teacherFields');
const parentFields = document.getElementById('parentFields');

roleSelect.addEventListener('change', function () {
    // Hide all conditional fields first
    document.querySelectorAll('.conditional-field').forEach(field => {
        field.classList.remove('show');
    });

    // Show relevant fields based on selected role
    if (this.value === 'student') {
        studentFields.classList.add('show');
    } else if (this.value === 'teacher') {
        teacherFields.classList.add('show');
    } else if (this.value === 'parent') {
        parentFields.classList.add('show');
    }
});