const themeToggle = document.getElementById('themeToggle');
const body = document.body;

if (themeToggle) {
    const icon = themeToggle.querySelector('i');

    const applyTheme = (theme) => {
        body.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        if (icon) {
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
    };

    themeToggle.addEventListener('click', () => {
        const currentTheme = body.getAttribute('data-theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        applyTheme(newTheme);
    });

    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        applyTheme(savedTheme);
    } else {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(prefersDark ? 'dark' : 'light');
    }
}

const menuToggle = document.getElementById('menuToggle');
// const navMenu = document.getElementById('navMenu');
const menuOverlay = document.getElementById('menuOverlay');

// if (menuToggle && navMenu && menuOverlay) {
//     const menuIcon = menuToggle.querySelector('i');

//     const closeMenu = () => {
//         navMenu.classList.remove('active');
//         menuOverlay.classList.remove('active');
//         menuToggle.classList.remove('active');
//         if (menuIcon) {
//             menuIcon.className = 'fas fa-bars';
//         }
//     };

//     const toggleMenu = () => {
//         const isActive = navMenu.classList.toggle('active');
//         menuOverlay.classList.toggle('active');
//         menuToggle.classList.toggle('active');
//         if (menuIcon) {
//             menuIcon.className = isActive ? 'fas fa-times' : 'fas fa-bars';
//         }
//     };

//     menuToggle.addEventListener('click', toggleMenu);
//     menuOverlay.addEventListener('click', closeMenu);
//     document.addEventListener('keydown', (e) => {
//         if (e.key === 'Escape' && navMenu.classList.contains('active')) {
//             closeMenu();
//         }
//     });
// }

console.log('general script is loaded!');