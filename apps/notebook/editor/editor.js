// Text formatting functions
function formatText(command, value = null) {
    document.execCommand(command, false, value);
    updateWordCount();
}

function insertLink() {
    const url = prompt('Enter URL:', 'https://');
    if (url) {
    formatText('createLink', url);
    }
}

function insertImage() {
    const url = prompt('Enter image URL:', 'https://');
    if (url) {
    formatText('insertImage', url);
    }
}

// Update word and character count
function updateWordCount() {
    const text = document.querySelector('.editor-content').innerText;
    const wordCount = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
    const charCount = text.length;
    
    document.getElementById('word-count').textContent = `${wordCount} words`;
    document.getElementById('char-count').textContent = `${charCount} characters`;
}

// Initialize word count
document.addEventListener('DOMContentLoaded', function() {
    updateWordCount();
    
    // Update word count on input
    document.querySelector('.editor-content').addEventListener('input', updateWordCount);
    
    // Update title on input
    document.querySelector('.note-title-input').addEventListener('input', function() {
    document.title = `${this.value} - StudyTont`;
    });
});