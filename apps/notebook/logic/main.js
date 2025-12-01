const userNotesInput = document.getElementById('user-notes');
const saveBtn = document.getElementById('save-btn');
const noteTitleInput = document.getElementById('note-name');
// const deleteBtn = document.getElementById('delete-btn');
let savedData = JSON.parse(localStorage.getItem('notesObj'));
console.log(savedData);

const urlParams = new URLSearchParams(window.location.search)
const opnedNote = urlParams.get('open');
console.log(opnedNote);

if (opnedNote !== null) {
    viewNote(opnedNote);
}

function createNewNote() {
    let noteTitle = noteTitleInput.value;
    let userInput = userNotesInput.innerHTML;

    if (localStorage.getItem('notesObj') === null) {
        const dataObj = {
            "notes": []
        };

        localStorage.setItem('notesObj', JSON.stringify(dataObj));
    };

    let savedData = JSON.parse(localStorage.getItem('notesObj'));

    let dataObj = {
        title: noteTitle,
        content: userInput
    }

    savedData.notes.push(dataObj);
    localStorage.setItem('notesObj', JSON.stringify(savedData));
    console.log(savedData);

    return noteTitle;
}

function updateNote(noteTitle) {
    let savedData = JSON.parse(localStorage.getItem('notesObj'));

    let userInput = userNotesInput.innerHTML;

    for (const element of savedData.notes) {
        if (element.title === noteTitle) {
            console.log("note found");
            element.content = userInput;
            console.log(element)
            console.log(savedData);
            localStorage.setItem('notesObj', JSON.stringify(savedData));
            break;
        }
    }

}

function viewNote(note) {
    let savedData = JSON.parse(localStorage.getItem('notesObj'));

    for (const element of savedData.notes) {
        if (element.title === note) {
            console.log("note found");
            console.log(element)
            console.log(savedData);

            userNotesInput.innerHTML = element.content;
            noteTitleInput.value = element.title;
            break;
        }
    }
}

let createdOne = null;

saveBtn.addEventListener('click', () => {
    if (opnedNote !== null) {
        updateNote(opnedNote);
    } else {
        if (createdOne === null) {
            createdOne = createNewNote();
        } else {
            updateNote(createdOne);
        }
    }
    window.location.href = "../notes/index.php";
});