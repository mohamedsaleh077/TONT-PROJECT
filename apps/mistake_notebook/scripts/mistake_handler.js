const urlParams = new URLSearchParams(window.location.search);
const GET_SubjectValue = urlParams.get('sub');
const GET_MistakeID = urlParams.get('id');

const SubjectTitle = document.getElementById('title');
const SaveMistakeButton = document.getElementById('save-mistake');

const MistakeNameInput = document.getElementById('mistake-name');
const QuestionInput = document.getElementById('mistake-question');
const RightAnswerInput = document.getElementById('mistake-right-answer');
const WrongeAnswerInput = document.getElementById('mistake-wronge-answer');
const MistakeCommentInput = document.getElementById('comment');

SubjectTitle.innerText = "a mistake at " + GET_SubjectValue;

let currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));

const subjectExists = currentSavedList.subjects
    ?.some(subject => subject.name === GET_SubjectValue) || false;

if (subjectExists) {
    console.log("subject detected");
} else {
    console.log("subject not found");
    window.location.href = "./index.php";
}

SaveMistakeButton.addEventListener('click', () => {
    currentSavedList = JSON.parse(localStorage.getItem('mistakesNotebook'));

    let newdataObj = {
        "mistake-name": MistakeNameInput.value,
        "mistake-question": QuestionInput.value,
        "mistake-right-answer": RightAnswerInput.value,
        "mistake-wronge-answer": WrongeAnswerInput.value,
        "comment": MistakeCommentInput.value
    }

    currentSavedList.subjects.forEach((element, index) => {
        if (element.name === GET_SubjectValue) {
            // console.log(element, index);
            currentSavedList.subjects[index].mistakes.push(newdataObj);
        }
    });

    // console.log(currentSavedList);

    localStorage.setItem('mistakesNotebook', JSON.stringify(currentSavedList))
    const allInputs = document.querySelectorAll('input');
    allInputs.forEach(input => {
        input.value = '';
    });
    MistakeCommentInput.value = '';
    console.log(localStorage.getItem('mistakesNotebook'));
    window.location.href = "./subject.php?sub=" + GET_SubjectValue;
});




