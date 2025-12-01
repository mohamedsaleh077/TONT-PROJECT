// Password visibility toggle
const passwordToggle = document.getElementById('passwordToggle');
const passwordInput = document.getElementById('loginPassword');

passwordToggle.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    const eyeIcon = passwordToggle.querySelector('i');
    eyeIcon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
});
