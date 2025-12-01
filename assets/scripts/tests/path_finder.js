// importing the qustions
let qustionHTML = '';
let qustionNumber = 0;
let isAnswered = false;

let Vcount = 0;
let Acount = 0;
let Rcount = 0;
let Kcount = 0;
let YourPath;
let YourPathEX;

let selected = null;



function loadQustions() {
    selected = null;
    console.log(YourPath);
    if (qustionNumber > 19) {
        qustionHTML = `
            <div class="QuestionBlook">
                <p class="cetered-gray-text">Test Completed</p>
                <p class="centered-H1">الشعبة الامثل لك هي:${YourPath}</p>

            <div class="explainText">
                ${YourPathEX}
            </div>
            </div>
        
        `;

        document.querySelector('main').innerHTML = qustionHTML;


        // paragraph = document.querySelectorAll('p');
        // div = document.querySelectorAll('div');
        // console.log(sdiv);
        // console.log(paragraph);



        const chimestryDropdownText = document.querySelector('.chimestry-dropdown-block');







    } else {
        qustionHTML = `        
        <div class="QuestionBlook">
                <p class="cetered-gray-text">Question ${qustionNumber + 1 } of 20</p>
                <p class="centered-H1">${cumpusQuestions[qustionNumber].qustion}</p>
                <div class="answers">
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="V" name="qustionInput" value="V">
                            <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="V">${cumpusQuestions[qustionNumber].answers.answerA}</span>
                        </label>
                    </div>
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="A" name="qustionInput" value="A">
                            <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="A">${cumpusQuestions[qustionNumber].answers.answerB}</span>
                        </label>
                    </div>
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="R" name="qustionInput" value="R">
                            <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="R">
                                ${cumpusQuestions[qustionNumber].answers.answerC}
                            </span>
                        </label>
                    </div>
                    
                </div>
            </div>  
<button class="nextButton" onclick="
                if(isAnswered == true){
                // loadQustions()
                // setupDarkModeListeners();

                }
                ">التالي</button>
            
        `;
        document.querySelector('main').innerHTML = qustionHTML;




        // qustionNumber=qustionNumber+1;

        isAnswered = false;

        document.querySelectorAll('.yello-circle').forEach(yelloCircle => {
            yelloCircle.addEventListener('click', () => {
                if (isAnswered == false) {

                    // const answer = yelloCircle.value;

                    isAnswered = true;
                    // if(answer === 'V'){
                    //     Vcount++;
                    // }else if(answer === 'A'){
                    //     Acount++;
                    // }else if(answer === 'R'){
                    //     Rcount++;
                    // }else if(answer === 'K'){
                    //     Kcount++;
                    // }
                    // console.log(Vcount, Acount, Rcount, Kcount);
                }

            }
            );
        });

        document.querySelectorAll('.yello-circle').forEach(yelloCircle => {
            yelloCircle.addEventListener('click', () => {
                selected = document.querySelector('.yello-input:checked');
                console.log(selected);
                const answer = selected.value;
            })
        });

        document.querySelectorAll('.nextButton').forEach(nextBtn => {
            nextBtn.addEventListener('click', () => {

                console.log(selected)
                console.log(Vcount, Acount, Rcount, Kcount);

                if (selected) {
                    const answer = selected.value;
                    if (answer === 'V') {
                        Vcount++;
                    } else if (answer === 'A') {
                        Acount++;
                    } else if (answer === 'R') {
                        Rcount++;
                    } else if (answer === 'K') {
                        Kcount++;
                    }

                    // ✅ Move this block here
                    if (Vcount >= Acount && Vcount >= Rcount && Vcount >= Kcount) {
                        YourPath = 'الشعبة العلمية';
                        YourPathEX = 'تهتم هذه الشعبة بدراسة الكائنات الحية والعلوم التطبيقية. إذا كنت شغوفًا بمعرفة كيف يعمل جسم الإنسان، أو مهتمًا بالبيئة، النباتات، والحيوانات، فهذا المسار قد يكون الأنسب لك. يركز المنهج على مواد مثل الأحياء والكيمياء، ويفتح لك الباب لدراسة تخصصات مثل الطب، الصيدلة، طب الأسنان، العلاج الطبيعي، وعلوم الزراعة.';
                    } else if (Acount >= Vcount && Acount >= Rcount && Acount >= Kcount) {
                        YourPath = 'الشعبة الرياضية';
                        YourPathEX = 'تعتمد هذه الشعبة بشكل أساسي على التفكير المنطقي، حل المشكلات، وتطبيق النظريات العلمية. إذا كنت تحب التعامل مع الأرقام، المعادلات، والقوانين الفيزيائية، وتستمتع بالتحليل الدقيق، فهذا هو مسارك. المواد الأساسية هي الرياضيات بفرعيها (الجبر والهندسة) والفيزياء، وتؤهلك لدخول كليات الهندسة بجميع أقسامها، علوم الحاسب، الاقتصاد، والإحصاء.';
                    } else if (Rcount >= Vcount && Rcount >= Acount && Rcount >= Kcount) {
                        YourPath = 'الشعبة الادبية';
                        YourPathEX = 'تغوص هذه الشعبة في دراسة العلوم الإنسانية والاجتماعية. إذا كنت تحب القراءة، الكتابة، التعبير عن الأفكار، وتحليل الأحداث التاريخية وفهم المجتمعات، فإن هذا المسار مثالي لك. يركز المنهج على مواد مثل التاريخ، الجغرافيا، الفلسفة، وعلم النفس، ويؤهلك للالتحاق بكليات مثل الألسن، الحقوق، الإعلام، الاقتصاد والعلوم السياسية، والآداب.';
                    } else if (Kcount >= Vcount && Kcount >= Acount && Kcount >= Rcount) {
                        YourPath = 'الشعبة الفنية';
                    }

                    qustionNumber++;
                    isAnswered = false;
                    selected = null;

                    loadQustions(); // ✅ Now YourPath is already assigned
                } else {
                    alert("يجب عليك اختيار اجابة اولا قبل الاكمال.");
                }


            });



        });




    }
    ;

    document.querySelector('.nextButton').addEventListener('click', () => {
        setupDarkModeListeners();
        loadQustions()
    });

}


document.addEventListener("keydown", function (event) {
    console.log('key')
    if (event.key === "Enter") {
        console.log("Enter");

        console.log(selected);
        console.log(Vcount, Acount, Rcount, Kcount);

        if (selected) {
            const answer = selected.value;
            if (answer === 'V') {
                Vcount++;
            } else if (answer === 'A') {
                Acount++;
            } else if (answer === 'R') {
                Rcount++;
            } else if (answer === 'K') {
                Kcount++;
            }

            // ✅ Moved here
            if (Vcount >= Acount && Vcount >= Rcount && Vcount >= Kcount) {
                YourPath = 'الشعبة العلمية';
                YourPathEX = 'تهتم هذه الشعبة بدراسة الكائنات الحية والعلوم التطبيقية. إذا كنت شغوفًا بمعرفة كيف يعمل جسم الإنسان، أو مهتمًا بالبيئة، النباتات، والحيوانات، فهذا المسار قد يكون الأنسب لك. يركز المنهج على مواد مثل الأحياء والكيمياء، ويفتح لك الباب لدراسة تخصصات مثل الطب، الصيدلة، طب الأسنان، العلاج الطبيعي، وعلوم الزراعة.';
            } else if (Acount >= Vcount && Acount >= Rcount && Acount >= Kcount) {
                YourPath = 'الشعبة الرياضية';
                YourPathEX = 'تعتمد هذه الشعبة بشكل أساسي على التفكير المنطقي، حل المشكلات، وتطبيق النظريات العلمية. إذا كنت تحب التعامل مع الأرقام، المعادلات، والقوانين الفيزيائية، وتستمتع بالتحليل الدقيق، فهذا هو مسارك. المواد الأساسية هي الرياضيات بفرعيها (الجبر والهندسة) والفيزياء، وتؤهلك لدخول كليات الهندسة بجميع أقسامها، علوم الحاسب، الاقتصاد، والإحصاء.';
            } else if (Rcount >= Vcount && Rcount >= Acount && Rcount >= Kcount) {
                YourPath = 'الشعبة الادبية';
                YourPathEX = 'تغوص هذه الشعبة في دراسة العلوم الإنسانية والاجتماعية. إذا كنت تحب القراءة، الكتابة، التعبير عن الأفكار، وتحليل الأحداث التاريخية وفهم المجتمعات، فإن هذا المسار مثالي لك. يركز المنهج على مواد مثل التاريخ، الجغرافيا، الفلسفة، وعلم النفس، ويؤهلك للالتحاق بكليات مثل الألسن، الحقوق، الإعلام، الاقتصاد والعلوم السياسية، والآداب.';
            } else if (Kcount >= Vcount && Kcount >= Acount && Kcount >= Rcount) {
                YourPath = 'الشعبة الفنية';
            }

            qustionNumber++;
            isAnswered = false;
            selected = null;

            loadQustions(); // ✅ Correct order
        } else {
            alert("يجب عليك اختيار اجابة اولا قبل الاكمال.");
        }


    }
    ;
});

document.querySelector('.nextButton').addEventListener('click', () => {
    setupDarkModeListeners();
    loadQustions()
});






//document.querySelector('body').addEventListener('click', () => {
//    console.log(qustionNumber);
//});




// document.addEventListener('DOMContentLoaded', () => {
// const darkModeButton = document.querySelector('.nightMode');
// const body = document.body;
// const header = document.querySelector('header');
// const main = document.querySelector('main');
// let paragraph = document.querySelectorAll('p');
// let div = document.querySelectorAll('div');
// const a = document.querySelectorAll('a');
// const nav = document.querySelector('nav');

// darkModeButton.addEventListener('click', () => {
//     body.classList.toggle('dark-mode');
//     header.classList.toggle('dark-mode');
//     main.classList.toggle('dark-mode');
//     nav.classList.toggle('dark-mode');

//     paragraph.forEach(p => {
//         p.classList.toggle('dark-mode');
//     });

//     div.forEach(d => {
//         d.classList.toggle('dark-mode');
//     });

//     a.forEach(link => {
//         link.classList.toggle('dark-mode');
//     });
// })
// });




//function setupDarkModeListeners() {
//    console.log('opksdfposak[');
//    const darkModeButton = document.querySelector('.nightMode');
//    const body = document.body;
//    const header = document.querySelector('header');
//    const main = document.querySelector('main');
//    const nav = document.querySelector('nav');
//
//    let paragraph = document.querySelectorAll('p');
//    let div = document.querySelectorAll('div');
//    const a = document.querySelectorAll('a');
//
//    if (darkModeButton) {
//        darkModeButton.addEventListener('click', () => {
//            body.classList.toggle('dark-mode');
//            header.classList.toggle('dark-mode');
//            main.classList.toggle('dark-mode');
//            nav.classList.toggle('dark-mode');
//
//            paragraph.forEach(p => {
//                p.classList.toggle('dark-mode');
//            });
//
//            div.forEach(d => {
//                d.classList.toggle('dark-mode');
//            });
//
//            a.forEach(link => {
//                link.classList.toggle('dark-mode');
//            });
//        });
//    }
//}
//setupDarkModeListeners();
//
//// document.addEventListener('DOMContentLoaded', () => {
////     loadQustions(); 
////     setupDarkModeListeners();
//// });
