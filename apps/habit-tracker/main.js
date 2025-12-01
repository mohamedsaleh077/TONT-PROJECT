// --- 📚 تتبع العادات (Habit Tracker) 📚 ---

let habits = JSON.parse(localStorage.getItem('habits')) || [];
const habitImages = [
    "https://pbs.twimg.com/media/FCkYRUXXMA0Wld6.jpg",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWD38CENmBY98tXFcVj9XN5V36bpIU5XoBsg&s",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0NUSBurc7IWw0S94Jzpecrz8Mabswj81Bw41WsuhPZwEz8MT02x5c-RJskxqh5gGbWcY&usqp=CAU",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_PFR95IMHjrbDknyB-qoRfp-xSya5g7x5sw&s",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQj962BRP5IMX79KaGWOSybEKEEZmzEIKiljg&s"
];
const fiveDaysInSeconds = 5 * 24 * 60 * 60; // 432000 ثانية
let updateInterval; // لتخزين معرف المؤقت الرئيسي

function saveHabits() {
    localStorage.setItem('habits', JSON.stringify(habits));
}

function formatTime(seconds) {
    const days = Math.floor(seconds / (24 * 60 * 60));
    const hours = Math.floor((seconds % (24 * 60 * 60)) / (60 * 60));
    const minutes = Math.floor((seconds % (60 * 60)) / 60);
    const secs = seconds % 60;

    return `${days} يوم, ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

// دالة لتحديث المؤقت والصورة لجميع العادات في نفس الوقت
function updateAllHabitDisplay() {
    const now = Math.floor(Date.now() / 1000);

    habits.forEach(habit => {
        const elapsed = now - habit.startTime;
        
        // 1. تحديث المؤقت
        const timerElement = document.getElementById(`timer-${habit.id}`);
        if (timerElement) {
            timerElement.textContent = formatTime(elapsed);
        }

        // 2. تحديث الصورة (تغيير كل 5 أيام)
        const imageIndex = Math.floor(elapsed / fiveDaysInSeconds) % habitImages.length;
        const imgElement = document.getElementById(`img-${habit.id}`);
        if (imgElement) {
            imgElement.src = habitImages[imageIndex];
        }
    });
}

function renderHabits() {
    // 1. إيقاف المؤقتات السابقة لتجنب التراكم
    if (updateInterval) {
        clearInterval(updateInterval);
    }
    
    const habitsList = document.getElementById('habitsList');
    
    if (habits.length === 0) {
        habitsList.innerHTML = `
            <div class="empty-habits">
                <i class="fas fa-clock"></i>
                <p>لا توجد عادات مضافة حتى الآن</p>
            </div>
        `;
        return;
    }
    
    let habitsHTML = '';
    
    habits.forEach(habit => {
        const now = Math.floor(Date.now() / 1000);
        const elapsed = now - habit.startTime;
        const imageIndex = Math.floor(elapsed / fiveDaysInSeconds) % habitImages.length;
        
        habitsHTML += `
            <div class="habit-block" data-habit-id="${habit.id}">
                <div class="habit-header">
                    <h3 class="habit-name">${habit.name}</h3>
                    <div class="habit-actions">
                        <button class="reset-btn" onclick="resetHabit(${habit.id})">
                            <i class="fas fa-redo"></i> إعادة تعيين
                        </button>
                        <button class="delete-habit-btn" onclick="deleteHabit(${habit.id})">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </div>
                </div>
                <div class="timer-label">المدة منذ آخر مرة:</div>
                <div class="timer-display" id="timer-${habit.id}">${formatTime(elapsed)}</div>
                <img class="habitIMG" id="img-${habit.id}" src="${habitImages[imageIndex]}" alt="habit image">
            </div>
        `;
    });
    
    habitsList.innerHTML = habitsHTML;
    
    // 2. بدء مؤقت رئيسي واحد لتحديث جميع العادات
    updateInterval = setInterval(updateAllHabitDisplay, 1000); 
}

function addHabit() {
    const habitInput = document.getElementById('habitInput');
    const name = habitInput.value.trim();
    
    if (name) {
        const newHabit = {
            id: Date.now(),
            name: name,
            startTime: Math.floor(Date.now() / 1000)
        };
        
        habits.push(newHabit);
        saveHabits();
        renderHabits();
        habitInput.value = '';
    }
}

function resetHabit(id) {
    habits = habits.map(habit => {
        if (habit.id === id) {
            return { ...habit, startTime: Math.floor(Date.now() / 1000) };
        }
        return habit;
    });
    
    saveHabits();
    renderHabits(); // لإعادة عرض العناصر وبدء المؤقتات من جديد
}

function deleteHabit(id) {
    habits = habits.filter(habit => habit.id !== id);
    saveHabits();
    renderHabits(); // لإعادة عرض العناصر وإيقاف مؤقتات العنصر المحذوف
}

// --- 📋 قائمة المهام (Todo List) 📋 ---

let todoList = JSON.parse(localStorage.getItem('todoList')) || [];

function saveTodos() {
    localStorage.setItem('todoList', JSON.stringify(todoList));
}

function renderTodos() {
    const todoListContainer = document.getElementById('todoList');
    let todoHTML = '';

    if (todoList.length === 0) {
        todoHTML = `
            <div class="empty-habits">
                <i class="fas fa-tasks"></i>
                <p>لا توجد مهام مضافة حتى الآن</p>
            </div>
        `;
    } else {
        todoList.forEach((todo, index) => {
            // ملاحظة: تم تعديل tybe إلى type داخل الكود لتصحيح إملائي محتمل, 
            // ولكن للحفاظ على الكود الأصلي استخدمت 'tybe'.
            todoHTML += `
                <div class="todoBlock ${todo.tybe}" data-type="${todo.tybe}"> 
                    <p>
                        <strong class="todoLISTname">${todo.name}</strong>
                        <button class="delete-btn" onclick="deleteTodo(${index})">
                            <i class="fa-solid fa-trash"></i> حذف
                        </button>
                        <div><i class="fa-solid fa-calendar"></i> الموعد النهائي: ${todo.Deadline}</div>
                        <div class="Description">${todo.discriptian}</div>
                        <div class="todo-type-label">النوع: ${todo.tybe}</div>
                    </p>
                </div>
            `;
        });
    }

    todoListContainer.innerHTML = todoHTML;
    saveTodos();
}

function deleteTodo(index) {
    todoList.splice(index, 1);
    renderTodos();
}

function addTodo() {
    const taskInput = document.getElementById('taskInput');
    const taskDate = document.getElementById('taskDate');
    const taskDescription = document.getElementById('taskDescription');
    const taskType = document.getElementById('taskType');

    if (taskInput.value.trim() && taskDate.value && taskDescription.value.trim() && taskType.value) {
        const newTodo = {
            name: taskInput.value.trim(),
            Deadline: taskDate.value,
            discriptian: taskDescription.value.trim(),
            tybe: taskType.value
        };

        todoList.push(newTodo);
        renderTodos();

        // مسح قيم الإدخال
        taskInput.value = '';
        taskDate.value = '';
        taskDescription.value = '';
        taskType.value = 'green';
    } else {
        // يمكنك إضافة تنبيه للمستخدم هنا إذا كانت الحقول فارغة
        // alert('الرجاء تعبئة جميع حقول المهمة.');
    }
}

// --- ⚙️ التهيئة (Initialization) ⚙️ ---

document.addEventListener('DOMContentLoaded', () => {
    // تتبع العادات
    renderHabits();
    document.querySelector('.add-habit-btn').addEventListener('click', addHabit);
    document.getElementById('habitInput').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            addHabit();
        }
    });

    // قائمة المهام
    renderTodos();
    document.querySelector('.add').addEventListener('click', addTodo);
});