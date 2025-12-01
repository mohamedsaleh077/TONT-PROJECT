

const MainGrid = document.getElementById('notes-grid');

if (localStorage.getItem('notesObj') === null) {
    MainGrid.innerHTML = "<h1>لا توجد ملاحظات بعد</h1>"
} else {
    let savedData = JSON.parse(localStorage.getItem('notesObj'));
    console.log(savedData);
    printNotes();
}

function printNotes() {
    MainGrid.innerHTML = '';
    let savedData = JSON.parse(localStorage.getItem('notesObj'));
    if (savedData.notes.length !== 0) {
        savedData.notes.forEach((element, index) => {
            console.log(element);
            MainGrid.innerHTML += `
        <div class="note-card">
            <div class="note-header">
                <a href="../editor/index.php?open=${element.title}">
                    <h3 class="note-title">${element.title}</h3>
                </a>
                <i class="fa-solid fa-trash delete-icon" onclick="deleteNote(${index});"></i>
            </div>
            <a href="../editor/index.php?open=${element.title}">
                <div class="note-content">
                    ${element.content}
                </div>
            </a>
        </div>
        `;
        });
    } else {
        MainGrid.innerHTML = "<h1>لا توجد ملاحظات بعد</h1>";
    }
}

function deleteNote(index) {
    let savedData = JSON.parse(localStorage.getItem('notesObj'));
    savedData.notes.splice(index, 1);
    console.log(savedData);
    localStorage.setItem('notesObj', JSON.stringify(savedData));
    printNotes();
}