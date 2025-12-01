// JavaScript for menu toggle, theme toggle, and persistent tabs
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    const themeToggle = document.getElementById('themeToggle');
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    
    // --- Constant for localStorage Key ---
    const ACTIVE_TAB_KEY = 'activeTabId';
    // -------------------------------------

    // Menu toggle functionality
    menuToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        menuOverlay.classList.toggle('active');
        menuToggle.classList.toggle('active');
    });

    // Close menu when clicking on overlay
    menuOverlay.addEventListener('click', function() {
        navMenu.classList.remove('active');
        menuOverlay.classList.remove('active');
        menuToggle.classList.remove('active');
    });

    // Theme toggle functionality (existing code, unchanged)
    themeToggle.addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        themeToggle.innerHTML = newTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        
        // Save theme preference to localStorage
        localStorage.setItem('theme', newTheme);
    });

    // Load saved theme preference (existing code, unchanged)
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    }

    // --------------------------------------------------------------------------------
    // Tab functionality (Refactored for Persistence)
    // --------------------------------------------------------------------------------

    // Helper function to switch tabs
    function switchTab(targetTabId) {
        // 1. Remove active class from all tabs and contents
        tabs.forEach(t => t.classList.remove('active'));
        tabContents.forEach(c => c.classList.remove('active'));
        
        // 2. Add active class to the selected tab button and its content
        const targetTabButton = document.querySelector(`.tab[data-tab="${targetTabId}"]`);
        const targetContent = document.getElementById(targetTabId);
        
        if (targetTabButton && targetContent) {
            targetTabButton.classList.add('active');
            targetContent.classList.add('active');
            
            // 3. Save the active tab ID to localStorage
            localStorage.setItem(ACTIVE_TAB_KEY, targetTabId);
        }
    }

    // 1. Event listener for tab clicks (saves the preference)
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            switchTab(targetTab);
        });
    });

    // 2. Initial load: Check for saved tab or default to the first tab
    const savedTabId = localStorage.getItem(ACTIVE_TAB_KEY);
    
    if (savedTabId) {
        // Load the saved tab
        switchTab(savedTabId);
    } else if (tabs.length > 0) {
        // If no saved tab, activate the first tab as a default
        tabs[0].click(); // Simulate a click on the first tab
    }
});