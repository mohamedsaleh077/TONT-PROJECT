// importing the qustions
let qustionHTML = '';
let qustionNumber = 0;
let isAnswered = false;

let Vcount = 0;
let Acount = 0;
let Rcount = 0;
let Kcount = 0;
let YourStyle;

let selected = null;


// qustionNumber=22;
function loadQustions(){
    selected = null;
    if (qustionNumber>10){
        YourStyle = calcStyle();

                            // ====================== AI Advice Generation ======================
                            let AIadvice = "جارٍ توليد النصيحة من الذكاء الاصطناعي...";

                            (async () => {
                                try {
                                    const aiProxyEndpoint = '/api/ai.php'; // مسار الـ Proxy للذكاء الاصطناعي
                                    const promptText = `المستخدم يفضل ${YourStyle} في المذاكرة. 
                            أعطه نصيحة قصيرة وعملية (جملة أو جملتين) مخصصة له لتحسين طريقة تعلمه.`;

                                    const requestData = { text: promptText };

                                    const response = await fetch(aiProxyEndpoint, {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify(requestData)
                                    });

                                    if (!response.ok) throw new Error(`AI Proxy returned status ${response.status}`);

                                    const result = await response.text(); // الـ PHP المفروض يرجع النص الناتج فقط

                                    if (result && result.trim().length > 0) {
                                        AIadvice = result.trim();
                                    } else {
                                        AIadvice = "⚠️ لم يتمكن الذكاء الاصطناعي من توليد نصيحة هذه المرة، حاول لاحقًا.";
                                    }
                                } catch (err) {
                                    console.error('AI advice error:', err);
                                    AIadvice = "حدث خطأ أثناء الاتصال بالذكاء الاصطناعي. حاول لاحقًا.";
                                } finally {
                                    // إدراج النصيحة داخل الصفحة بعد عرض نتيجة الاختبار
                                    document.querySelector('main').insertAdjacentHTML('beforeend', `
                                        <div class="ai-advice-block">
                                            <h3 class="centered-H1">🤖 نصيحة الذكاء الاصطناعي:</h3>
                                            <p class="explainText">${AIadvice}</p>
                                        </div>
                                    `);
                                }
                            })();

        qustionHTML = `
            <div class="QuestionBlook">
                <p class="cetered-gray-text">انتهى الاختبار</p>
                <p class="centered-H1">الاسلوب الامثل لك هو :${YourStyle}</p>
                <p class="explainText"> 👁️نسبة انحيازك للاسلوب البصري: ${((Vcount/11)*100).toFixed(2)}%<p>
                <p class="explainText"> 🎧نسبة انح  يازك للاسلوب السمعي: ${((Acount/11)*100).toFixed(2)}%<p>
                <p class="explainText"> 📖نسبة انحيازك للاسلوب القرائي/الكتابي: ${((Rcount/11)*100).toFixed(2)}%<p>
                <p class="explainText"> 🏃‍♂️نسبة انحيازك للاسلوب الحركي: ${((Kcount/11)*100).toFixed(2)}%<p>
                <p class="explainText"> ✨ استمر في تطوير طريقتك المفضلة، وجرب دمجها مع أساليب أخرى لزيادة الفاعلية.<p>

                <br>
                <br>
        



            </div>
        `;

        document.querySelector('main').innerHTML= qustionHTML;




        const chimestryDropdownText = document.querySelector('.chimestry-dropdown-block');

        const dropdownBtn = document.querySelector('.chimestry-dropdown');
        const dropdownBlock = document.querySelector('.chimestry-dropdown-block');
        if (dropdownBtn) {
            dropdownBtn.addEventListener('click', () => {
                dropdownBlock.style.display = 
                    dropdownBlock.style.display === 'block' ? 'none' : 'block';
            });
        }
        return;
        




        

    }
    else {
        qustionHTML = `        
        <div class="QuestionBlook">
                <p class="cetered-gray-text">Question ${qustionNumber + 1 } of 11</p>
                <p class="centered-H1">${VARKQuestions[qustionNumber].qustion}</p>
                <div class="answers">
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="V" name="qustionInput" value="V">
                            <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="V">${VARKQuestions[qustionNumber].answers.answerV}</span>
                        </label>
                    </div>
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="A" name="qustionInput" value="A">
                            <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="A">${VARKQuestions[qustionNumber].answers.answerA}</span>
                        </label>
                    </div>
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="R" name="qustionInput" value="R">
                            <span class="custom-radio yello-circle"> </span> <span class="TheAnswers" data-value="R">
                                ${VARKQuestions[qustionNumber].answers.answerR}
                            </span>
                        </label>
                    </div>
                    <div class="answerBlock">
                        <label class="answer-label">
                            <input type="radio" class="yello-circle yello-input" id="K" name="qustionInput" value="K">
                            <span class="custom-radio yello-circle"> </span><span class="TheAnswers" data-value="K">
                                ${VARKQuestions[qustionNumber].answers.answerK}
                            </span>
                        </label>
                    </div>
                </div>
            </div>  
<button class="nextButton" onclick="
                if(isAnswered == true){

                }
                ">التالي</button>
            
        `;
        document.querySelector('main').innerHTML= qustionHTML;


                
        isAnswered = false;

        document.querySelectorAll('.yello-circle').forEach(yelloCircle => {
        yelloCircle.addEventListener('click', () => {
            if(isAnswered == false){


                isAnswered = true;
            }

            }
        );
        });

        document.querySelectorAll('.yello-circle').forEach(yelloCircle => {
        yelloCircle.addEventListener('click', () => {
                selected = document.querySelector('.yello-input:checked');
                console.log(selected);
                const answer = selected.value;
        })});



        document.querySelectorAll('.nextButton').forEach(nextBtn => {
            nextBtn.addEventListener('click', () => {

                theOne()
            })});





            document.addEventListener("keydown", function(event) {
                console.log('key')
                if (event.key === "Enter") {
                    console.log("Enter");
                    theOne()
                }})
                
                                        


document.querySelector('body').addEventListener('click', () => {
    console.log(qustionNumber);
});

    }










function theOne(){

        console.log(selected)
        console.log(Vcount, Acount, Rcount, Kcount);

        

    if (selected) {
        const answer = selected.value;
        if(answer === 'V'){
            Vcount++;
        }else if(answer === 'A'){
            Acount++;
        }else if(answer === 'R'){
            Rcount++;
        }else if(answer === 'K'){
            Kcount++;
        }
        console.log(Vcount, Acount, Rcount, Kcount);

        qustionNumber=qustionNumber+1;
        isAnswered = false;
        loadQustions();
        selected = null;
    } else {
        alert("يجب عليك اختيار اجابة اولا قبل الاكمال.");
    };

    if(Vcount >= Acount){
        if(Vcount >= Rcount){
            if(Vcount >= Kcount){
                YourStyle = 'الاسلوب البصري';
            }
        }
    };
    if(Acount >= Vcount){
        if(Acount >= Rcount){
            if(Acount >= Kcount){
                YourStyle = 'الاسلوب السمعي';
            }
        }
    };
    if(Rcount >= Vcount){
        if(Rcount >= Acount){
            if(Rcount >= Kcount){
                YourStyle = 'الاسلوب القرائي/الكتابي';
            }
        }
    };
    if(Kcount >= Vcount){
        if(Kcount >= Acount){
            if(Kcount >= Rcount){
                YourStyle = 'الاسلوب الحركي ';
            }
        }
    };

            document.querySelector('.chimestry-dropdown').addEventListener('click', () => {
        if (chimestryDropdownText.style.display === 'none') {
            chimestryDropdownText.style.display = 'block';
        } else {
            chimestryDropdownText.style.display = 'none';
        }
        }
    );


    document.querySelector('.nextButton').addEventListener('click',()=>{
        setupDarkModeListeners();
    });

    
}};


function calcStyle() {
    if (Vcount >= Acount && Vcount >= Rcount && Vcount >= Kcount) {
        return 'الاسلوب البصري';
    }
    if (Acount >= Vcount && Acount >= Rcount && Acount >= Kcount) {
        return 'الاسلوب السمعي';
    }
    if (Rcount >= Vcount && Rcount >= Acount && Rcount >= Kcount) {
        return 'الاسلوب القرائي/الكتابي';
    }
    if (Kcount >= Vcount && Kcount >= Acount && Kcount >= Rcount) {
        return 'الاسلوب الحركي';
    }
}
