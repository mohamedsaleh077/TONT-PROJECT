const HistoryIcon = document.getElementById('history-toggle');
const HistoryList = document.getElementById('history-container');


HistoryIcon.addEventListener('click', () => {
    HistoryList.classList.toggle('active');
});


document.addEventListener('DOMContentLoaded', () => {
    // Other code...

    const prompButton = document.getElementById('promp');
    const promptsMenu = document.getElementById('prompts-menu');
    const promptChips = document.querySelectorAll('.prompt-chip');
    const userInput = document.getElementById('user-promot');

    // Open/close the menu
    prompButton.addEventListener('click', (e) => {
        e.stopPropagation();
        promptsMenu.classList.toggle('show-menu');
        prompButton.classList.toggle('active');
    });

    // Close the menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!promptsMenu.contains(e.target) && e.target !== prompButton) {
            promptsMenu.classList.remove('show-menu');
            prompButton.classList.remove('active');
        }
    });

    // Handle clicks on menu items (the chips)
    // Here's the fix: Loop through each chip and add an event listener
    promptChips.forEach(chip => {
        chip.addEventListener('click', (e) => {
            // Prevent the click from propagating to the document and closing the menu
            e.stopPropagation(); 
            
            // First, remove the 'active' class from all other chips
            // This ensures only one chip is highlighted at a time
            promptChips.forEach(otherChip => {
                otherChip.classList.remove('active');
            });
            
            // Then, add the 'active' class to the clicked chip
            chip.classList.toggle('active');

            // userInput.value = chip.textContent;
            promptsMenu.classList.remove('show-menu');
            userInput.focus();
        });
    });

    // Prevent closing the menu when clicking inside it
    promptsMenu.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});
