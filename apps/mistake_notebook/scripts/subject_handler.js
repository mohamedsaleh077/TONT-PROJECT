const addButton = document.getElementById('add-subject'); // the floating + button
const addSubject = document.getElementById('create-subject'); // new subject div
const saveSubject = document.getElementById('save-subject'); // save subject input
const subjectName = document.getElementById('subect-name'); // subject input
const clearButton = document.getElementById('clear');
const changeButton = document.getElementById('save-changes');
// const changeSubjectInput = document.getElementById('change-subject-input');

const subjectList = document.getElementById('subject-list');

let addSubjectShowen = false;
let currentSavedList;

if (localStorage.getItem('mistakesNotebook') === null) {
    let data = {
        "subjects": []
    };
    localStorage.setItem('mistakesNotebook', JSON.stringify(data))
} else {
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
}

function hideSubjectInput() {
    subjectName.value = '';
    addSubject.style.display = 'none';
    addButton.innerText = '+';
}

function showSubjectInput() {
    addSubject.style.display = 'flex';
    addButton.innerText = '-';
}

function printSubjects() {
    subjectList.innerHTML = '';
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
    if (currentSavedList.subjects.length !== 0) {
        currentSavedList.subjects.forEach(element => {
            // console.log(element.name);
            subjectList.innerHTML += `
                <!-- subject -->
                
                <div class="subject-name">
                <a href="./subject.php?sub=${element.name}">
                    <p>${element.name}</p>
                </a>
                    <!-- subject controls -->
                    <div class="controls">
                        <button class="delete controls-buttons" onclick="delteSubject('${element.name}');">
                            <img src="./assets/delete-2-svgrepo-com.svg" alt="delete">
                        </button>
                        <button class="edit controls-buttons" onclick="editSubject('${element.name}');">
                            <img src="./assets/edit-3-svgrepo-com.svg" alt="edit">
                        </button>
                    </div>
                </div>

                <!-- edit subject -->
                <div class="subject-name change-subject" id='${element.name}'>
                    <input id='${element.name}-input' class="subject-name-input" type="text" placeholder="change subject name to...">
                    <button class="save" id='save-changes-${element.name}'>change</button>
                </div>
            </div>
            
            `;
        });
        clearButton.style.display = 'block'
    } else {
        subjectList.innerHTML = '<p class="subject-name">لم يتم اضافة اي مادة بعد</p>'
        clearButton.style.display = 'none'
    }
}
printSubjects();

// function toggleChangeSubject() {
//   const box = document.querySelector('.change-subject');
//   box.classList.toggle('open');
// }

function delteSubject(subject) {
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
    currentSavedList.subjects.forEach((element, index) => {
        console.log(element.name);
        if (element.name === subject) {
            // showSubjectInput();
            // subjectName.value = subject;
            // saveSubject.style.display = 'none';
            // changeButton.style.display = 'block'
            currentSavedList.subjects.splice(index, 1);
        }
    });
    localStorage.setItem('mistakesNotebook', JSON.stringify(currentSavedList))
    printSubjects();
}

let editSubjectToggel = false;
let currentOpenSubject = null;

function editSubject(subject) {
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
    // let currentOpenSubject = document.getElementById(subject);

    elements = document.querySelectorAll('.change-subject');
    elements.forEach(element => {
        // collapse all first
        element.style.maxHeight = '0px';
        element.style.padding = '0px';
    });

    if (currentOpenSubject === subject) {
        // If clicking the same subject, just close it
        currentOpenSubject = null;
        return;
    }

    currentSavedList.subjects.forEach((element, index) => {
        // console.log(element.name);
        if (element.name === subject) {
            currentOpenSubject = subject;
            let editBox = document.getElementById(element.name);
            // console.log(editBox);
            editBox.style.maxHeight = '100px';
            editBox.style.padding = '20px';
            editSubjectToggel = true;

            let changeSubjectInput = document.getElementById(element.name + '-input');
            changeSubjectInput.value = element.name;

            const changeButton = document.getElementById('save-changes-' + subject);
            changeButton.addEventListener('click', () => {
                console.log(subject);
                console.log(changeSubjectInput.value);
                currentSavedList.subjects[index].name = changeSubjectInput.value;
                console.log(currentSavedList);
                localStorage.setItem('mistakesNotebook', JSON.stringify(currentSavedList));
                printSubjects();
            });
        }
    });
}

addButton.addEventListener('click', () => {
    addSubjectShowen = (addSubjectShowen) ? false : true;
    // this short condition check for the add subject statue 
    if (addSubjectShowen) {
        printSubjects();
        showSubjectInput()
    } else {
        hideSubjectInput()
    }
});

saveSubject.addEventListener('click', () => {
    let userInput = subjectName.value;
    console.log(userInput);
    let subjectObj = {
        "name": userInput,
        "mistakes": []
    };
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
    currentSavedList.subjects.push(subjectObj);
    localStorage.setItem('mistakesNotebook', JSON.stringify(currentSavedList))
    // console.log(currentSavedList);
    printSubjects();
    hideSubjectInput();
    addSubjectShowen = false;
});
