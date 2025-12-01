let promp = "انت استاذ مصري ملم بالمنهج المصري في كل المواد اسمك هو تونت اسستنت اجاباتك احترافيه وقصيره نسبيا باللغة العربية في اغلب الاحيان في اغلب الاحيان الا عندما يستلزم الامر اجابه مطوله اكثر اجب عن الاتي بتلك الشخصية:";
const sendButton = document.getElementById('submit');
const userPromptTextarea = document.getElementById('user-promot');
const chatHistory = document.getElementById('chat-body');
const welcome = document.getElementById('welcome-message');
const HistoryListHTML = document.getElementById('history-list');

let welcomeActive = true;
let sendNotAllow = false;

// Initialize variables and localStorage
let isHistoryStart = false;
let currentIndex = null;

// Initialize localStorage if not exists
if (localStorage.getItem('aiHistory') === null) {
    const dataObj = {
        "history": []
    };
    localStorage.setItem('aiHistory', JSON.stringify(dataObj));
}

// Update history list on page load
historyListUpdate();


// add Return button listenr for sending messages
document.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    if (event.shiftKey) {
      // let it create a newline
      return;
    }
    if (sendNotAllow === false && window.innerWidth > 700) {
      event.preventDefault();
      sendTheMassige();
    }
  }
});


// add listener for sending button
sendButton.addEventListener('click', () => {
    sendTheMassige();
});

historyListUpdate()

let messageId = 0;
function sendTheMassige() {
    sendNotAllow = true;
    let userPropt = userPromptTextarea.innerText;
    console.log(userPropt);
    if (!(userPropt === "")) {
        if (welcomeActive) {
            welcome.style.display = 'none';
            welcomeActive = false;
        }
        userPromptTextarea.innerText = "";
        sendButton.disabled = true;
        sendButton.style.setProperty('pointer-events', 'none');
        chatHistory.innerHTML += `<div><div class="user-message-text"><pre id="${messageId}">${userPropt}</pre></div><button class="copy-button" onclick="copyMessage(${messageId})"><i class="fa-solid fa-copy"></i></button></div>`;
        messageId++;

        console.log("Sending...");
        userPromptTextarea.dataset.placeholder = "جار ارسال رسالتك, يرجي الانتظار...";

        fetch("/api/ai.php", {
            method: "post",
            body: JSON.stringify({ text: `${promp}` + userPropt + "'" }),
        })
            .then((res) => res.text())
            .then((res) => {
                console.log("Response arrived");
                let respond = marked.parse(res); // The response is parsed into HTML
                chatHistory.innerHTML += `<div class="bot-respond-body"><div class="bot-message-text"><pre id="${messageId}">${respond}</pre></div><button class="copy-button" onclick="copyMessage(${messageId})"><i class="fa-solid fa-copy"></i></button></div>`;
                messageId++;
                sendNotAllow = false;
            })

            .catch((err) => {
                console.log("Error", err);
                notify("Error:" + err)
                sendNotAllow = false;
            })

            .finally(() => {
                sendButton.disabled = false;
                sendButton.style.setProperty('pointer-events', 'auto');
                chatHistory.scrollTop = chatHistory.scrollHeight;
                userPromptTextarea.dataset.placeholder = "اكتب ردك هنا...";
                userPromptTextarea.innerText = "";
                saveChat();
                historyListUpdate()
            });
    }

}

function copyMessage(id) {
    id = id.toString();
    let txt = document.getElementById(id).innerText;

    navigator.clipboard.writeText(txt)
        .then(() => {
            console.log("Copied: " + txt);
            notify("✓ تم نسخ الرسالة الى الحافظة!");
        })
        .catch(err => {
            notify("حدث خطأ اثناء النسخ!");
        });
}

function notify(txt) {
    let notify = document.getElementById("notify");
    notify.innerText = txt;
    notify.style.opacity = '1';

    setTimeout(() => {
        console.log("Fading out notification");
        notify.style.opacity = '0';
    }, 3000);

}

function ClearAll() {
    localStorage.clear();
    isHistoryStart = false;
    currentIndex = null;

    chatHistory.innerHTML = '';
    welcome.style.display = 'block';

    location.reload();
}

function newChat() {
    isHistoryStart = false;
    currentIndex = null;

    HistoryList.classList.toggle('active');

    chatHistory.innerHTML = '';
    welcome.style.display = 'none';
}

function saveChat() {
    let CurrentChatHistory;
    let first30Characters = chatHistory.innerText.slice(0, 30);
    let savedHistory;

    if (isHistoryStart === false) {
        CurrentChatHistory = chatHistory.innerHTML;
        savedHistory = JSON.parse(localStorage.getItem('aiHistory'));

        isHistoryStart = true;
        let newHistorySetup = {
            name: first30Characters,
            history: CurrentChatHistory
        };

        savedHistory.history.push(newHistorySetup);
        localStorage.setItem('aiHistory', JSON.stringify(savedHistory));
        historyListUpdate();
    } else {
        savedHistory = JSON.parse(localStorage.getItem('aiHistory'));
        let lastIndex;

        if (currentIndex !== null) {
            lastIndex = currentIndex;
            // Create a copy and reverse for updating without modifying the original array
            const reversedHistory = [...savedHistory.history].reverse();
            reversedHistory[lastIndex].history = chatHistory.innerHTML;
            reversedHistory[lastIndex].name = chatHistory.innerText.slice(0, 30);
            savedHistory.history = reversedHistory.reverse();
        } else {
            lastIndex = savedHistory.history.length - 1;
            savedHistory.history[lastIndex].history = chatHistory.innerHTML;
            savedHistory.history[lastIndex].name = chatHistory.innerText.slice(0, 30);
        }

        localStorage.setItem('aiHistory', JSON.stringify(savedHistory));
        historyListUpdate();
    }
}

function LoadHistory(index) {
    HistoryList.classList.toggle('active');
    chatHistory.innerHTML = "";
    welcome.style.display = 'none';

    const savedHistory = JSON.parse(localStorage.getItem('aiHistory'));
    // Create a reversed copy for display without modifying the original array
    const reversedHistory = [...savedHistory.history].reverse();
    chatHistory.innerHTML = reversedHistory[index].history;

    isHistoryStart = true;
    currentIndex = index;
}

function historyListUpdate() {
    HistoryListHTML.innerHTML = "";
    const savedHistory = JSON.parse(localStorage.getItem('aiHistory'));

    if (savedHistory.history.length === 0) {
        HistoryListHTML.innerHTML = `<div class="chat-record"><p class="chat-record-name">لا توجد سجلات للمحادثات سابقة</p></div>`;
    } else {
        // Display in reverse order (newest first)
        const reversedHistory = [...savedHistory.history].reverse();
        reversedHistory.forEach((element, index) => {
            HistoryListHTML.innerHTML += `
                        <div class="chat-record" onclick="LoadHistory(${index})">
                            <p class="chat-record-name">${element.name}</p>
                        </div>`;
        });
    }
}
