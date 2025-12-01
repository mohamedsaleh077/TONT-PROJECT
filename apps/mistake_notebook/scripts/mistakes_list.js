const urlParams = new URLSearchParams(window.location.search);
const SubjectTitle = document.getElementById('title'); // the floating + button
const MistakesListHTML = document.getElementById('mistakes-list'); // the floating + button
const clearButton = document.getElementById('clear');
const CreateMistake = document.getElementById('add-mistake-link');

const GET_SubjectValue = urlParams.get('sub');
CreateMistake.href = "./mistake.php?sub=" + GET_SubjectValue;

SubjectTitle.innerHTML += GET_SubjectValue;

let currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
let mistakesList = getMistakes().reverse();

function deleteMistake(index) {
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));
    let mistakes = mistakesList;
    mistakes.splice(index, 1);
    mistakes = mistakes.reverse();

    console.log(mistakes);

    currentSavedList.subjects.forEach(element => {
        console.log(element.name)
        if (element.name === GET_SubjectValue) {
            console.log("we are in", GET_SubjectValue)
            console.log("we found", element.mistakes)
            element.mistakes = mistakes;
        }
    });

    localStorage.setItem('mistakesNotebook', JSON.stringify(currentSavedList))
    printMistakes(mistakesList);
}

function getMistakes() {
    let list = [];
    if (currentSavedList.subjects.length !== 0) {
        console.log("the storage is not empty")
        currentSavedList.subjects.forEach(element => {
            console.log(element.name)
            if (element.name === GET_SubjectValue) {
                console.log("we are in", GET_SubjectValue)
                console.log("we found", element.mistakes)
                list = element.mistakes;
            }
        });
    }
    if (list.length !== 0) {
        return list
    } else {
        console.log("make a mistake :)");
        MistakesListHTML.innerHTML = '<div class="subject-name mistake"><p>make a mistake bro :)</p></div>'
    }
}

console.log(mistakesList);

function printMistakes(mistakesArray) {
    MistakesListHTML.innerHTML = '';
    mistakesArray.forEach((element, index) => {
        MistakesListHTML.innerHTML += `
            <div class="subject-name mistake">
                <p>${element["mistake-name"]}</p>

                <div class="controls">
                    <button class="delete controls-buttons" onclick="deleteMistake('${index}');">
                        <img src="./assets/delete-2-svgrepo-com.svg" alt="delete">
                    </button>
                    <button class="edit controls-buttons" onclick="editmistake('${element["mistake-name"]}');">
                        <img id='${element["mistake-name"]}-img' src="./assets/expand-view-svgrepo-com.svg" alt="edit">
                    </button>
                </div>
            </div>
            <!-- edit subject -->
            <div class="subject-name show-mistake change-subject" id='${element["mistake-name"]}'>
                <p class="q">${element["mistake-question"]}</p>
                <p class="r">${element["mistake-right-answer"]}</p>
                <p class="w">${element["mistake-wronge-answer"]}</p>
                <pre class="c">${element.comment}</pre>
            </div>
            `;
    });
}

printMistakes(mistakesList);

let currentOpenMistake = null;
let currentImageMistake = null;

function editmistake(mistake) {
    const clicked = document.getElementById(mistake);
    const clickedImg = document.getElementById(mistake + '-img');

    // close currently open (if it's not the same one)
    if (currentOpenMistake && currentOpenMistake !== clicked) {
        currentOpenMistake.style.maxHeight = '0px';
        currentOpenMistake.style.padding = '0px';
        if (currentImageMistake) {
            currentImageMistake.src = './assets/expand-view-svgrepo-com.svg';
        }
    }

    // toggle clicked one
    if (currentOpenMistake === clicked) {
        // closing the same
        clicked.style.maxHeight = '0px';
        clicked.style.padding = '0px';
        clickedImg.src = './assets/expand-view-svgrepo-com.svg';
        currentOpenMistake = null;
        currentImageMistake = null;
    } else {
        // open new
        clicked.style.maxHeight = 'max-content';
        clicked.style.padding = '20px';
        clickedImg.src = './assets/collapse-fullscreen-solid-svgrepo-com.svg';
        currentOpenMistake = clicked;
        currentImageMistake = clickedImg;
    }
}

let allExpanded = false;

function expandAll() {
    const img = document.getElementById('open-all-img');

    if (!allExpanded) {
        // expand all
        document.querySelectorAll('.show-mistake').forEach(el => {
            el.style.maxHeight = 'max-content';
            el.style.padding = '20px';
        });

        img.src = './assets/collapse-fullscreen-solid-svgrepo-com.svg';
        allExpanded = true;
    } else {
        // collapse all
        document.querySelectorAll('.show-mistake').forEach(el => {
            el.style.maxHeight = '0px';
            el.style.padding = '0px';
        });

        img.src = './assets/expand-view-svgrepo-com.svg';
        allExpanded = false;
    }
}
