// =======================set up to alllllllllll=====================
let theIntro=document.querySelector('.theIntro');
let theQustionsTimp=document.querySelector('.theQustionsTimp');
let theFinalScreen=document.querySelector('.theFinalScreen');

let qustionNumber = 0;
let isAnswered = true;
let startOrNot= false;

let Vcount = 0;
let Acount = 0;
let Rcount = 0;
let Kcount = 0;
let YourStyle;

let selected = 0;
let answer;



function startOrNotFunk(){
    if(startOrNot == false){
        console.log("Start button clicked");
        theIntro.classList.add('NOexest');
        theIntro.classList.remove('exest');

        theQustionsTimp.classList.remove('NOexest');
        theQustionsTimp.classList.add('exest');

        isAnswered = true;
        startOrNot = true;
    }
}

// ==================startBuT======================
document.getElementById('startBuT').addEventListener('click',()=>{
    clicked()
});

// ==================nextQustionBUT======================
document.getElementById('nextQustionBUT').addEventListener('click',()=>{
   clicked() 
});

function clicked() {
    startOrNotFunk()
    if(isAnswered == true){
        console.log("qustionNumber  "+qustionNumber);
        main();
        qustionNumber+=1
    }else {
        alert("يجب عليك اختيار اجابة اولا قبل الاكمال.");
    };
}

document.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        console.log("Enter has been pressed");
        startOrNotFunk()
        clicked()
    }
    if (event.key === " ") {
        console.log("Enter has been pressed");
        startOrNotFunk()
        clicked()
    }}
)

function main(){
    if (qustionNumber>10){
        theQustionsTimp.classList.add('NOexest');
        theQustionsTimp.classList.remove('exest');

        theFinalScreen.classList.remove('NOexest');
        theFinalScreen.classList.add('exest');

        AIAdviceGeneration();
    }
    else {
        loadQustionsAndAnounsments();

        // set it up
        document.querySelectorAll('.yello-circle').forEach(yelloCircle => {
        yelloCircle.addEventListener('click', () => {
                selected = document.querySelector('.yello-input:checked');
                answer = selected.value;
                console.log(selected);
                console.log(answer);
                isAnswered = true;
        })});
        countTheVark()
        endtask()

    };

    
};

function loadQustionsAndAnounsments(){
    document.getElementById("qustionNumber").innerHTML=qustionNumber+1;
    document.getElementById("theQustion").innerHTML=VARKQuestions[qustionNumber].qustion;

    document.getElementById("answerV").innerHTML=VARKQuestions[qustionNumber].answers.answerV;
    document.getElementById("answerA").innerHTML=VARKQuestions[qustionNumber].answers.answerA;
    document.getElementById("answerR").innerHTML=VARKQuestions[qustionNumber].answers.answerR;
    document.getElementById("answerK").innerHTML=VARKQuestions[qustionNumber].answers.answerK;




    
    document.getElementById("YourStyle").innerHTML=('الاسلوب الامثل لك هو: '+ YourStyle);
    document.getElementById("theQustion").innerHTML=VARKQuestions[qustionNumber].qustion;

    document.getElementById("VcountAnownce").innerHTML= '👁️نسبة انحيازك للاسلوب البصري: '+(((Vcount/11)*100).toFixed(2))+'%';
    document.getElementById("AcountAnownce").innerHTML= '🎧نسبة انحيازك للاسلوب السمعي: '+(((Acount/11)*100).toFixed(2))+'%';
    document.getElementById("RcountAnownce").innerHTML= '📖نسبة انحيازك للاسلوب القرائي/الكتابي: '+(((Rcount/11)*100).toFixed(2))+'%';
    document.getElementById("KcountAnownce").innerHTML= '🏃‍♂️نسبة انحيازك للاسلوب الحركي: '+(((Kcount/11)*100).toFixed(2))+'%';

}

function countTheVark(){
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
        console.log('YourStyle is '+YourStyle+'yet');

}

function endtask(){
    selected.checked = false;
    isAnswered = false;
    selected=null;
}

function AIAdviceGeneration(){

    // ====================== AI Advice Generation ======================
    let AIadvice = "جارٍ توليد النصيحة من tont-assistant...";
    let ai = document.getElementById('Ai-respond');

    (async () => {
        try {
            const aiProxyEndpoint = '/api/ai.php'; // مسار الـ Proxy للذكاء الاصطناعي
            const promptText = `المستخدم يفضل ${YourStyle} في المذاكرة. 
    أعطه نصيحة عملية مخصصة له لتحسين طريقة تعلمه.`;

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
                AIadvice = "⚠️ لم يتمكن tont-assistant من توليد نصيحة هذه المرة، حاول لاحقًا.";
            }
        } catch (err) {
            console.error('AI advice error:', err);
            AIadvice = "حدث خطأ أثناء الاتصال بtont-assistant. حاول لاحقًا.";
        } finally {
            // إدراج النصيحة داخل الصفحة بعد عرض نتيجة الاختبار
            ai.innerHTML =`
            <div class="ai-advice-block">
                <h3 class="centered-H1">🤖 نصيحة Tont-Assistant</h3>
                <p class="explainText">${marked.parse(AIadvice)}</p>
            </div>
            `;
        }
    })();

}