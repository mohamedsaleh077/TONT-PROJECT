<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
    <title>المهام والواجبات - تونت (مع Planner)</title>
  <style>
    /* ---------- Theme variables (from your original page) ---------- */
    :root {
      --bg-primary: #ffffff;
      --bg-secondary: #f8fafc;
      --bg-card: #ffffff;
      --text-primary: #1f2937;
      --text-secondary: #6b7280;
      --text-muted: #9ca3af;
      --border-color: #e5e7eb;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
      --accent-blue: #08367f;
      --accent-blue-hover: #062c66;
      --accent-yellow: #f59e0b;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;

      /* planner highlight (uses accent-blue by default) */
      --planner-highlight: rgba(8,54,127,0.12);
      --planner-dot: var(--accent-blue);
    }

    [data-theme="dark"] {
      --bg-primary: #1a1d29;
      --bg-secondary: #252834;
      --bg-card: #2d3142;
      --text-primary: #ffffff;
      --text-secondary: #a0a6b8;
      --text-muted: #6b7280;
      --border-color: #3a3f52;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3);
      --accent-blue: #4285f4;
      --accent-blue-hover: #1e40af;
      --accent-yellow: #facc15;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;

      --planner-highlight: rgba(66,133,244,0.12);
      --planner-dot: var(--accent-blue);
    }

    /* ---------- Base ---------- */
    * { 
box-sizing: border-box; 
margin: 0; 
padding: 0; 
}
    body {
      font-family: 'Cairo', sans-serif;
      background: var(--bg-secondary);
      color: var(--text-primary);
      line-height: 1.6;
      direction: rtl;
      transition: all 0.25s ease;
      min-height: 100vh;
    }

    a { 
text-decoration: none; 
color: inherit; 
}

    /* ---------- Header (copied / adapted) ---------- */
    .header {
      background: var(--accent-blue);
      color: white;
      padding: 1rem 2rem;
      box-shadow: var(--shadow-md);
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: white;
      font-size: 1.6rem;
      font-weight: 700;
      text-decoration: none;
    }

    .nav-main { 
display:flex; 
gap:1rem; 
align-items:center; 
}
    .nav-main a { 
color: rgba(255,255,255,0.9); 
padding:0.4rem 0.8rem; 
border-radius:8px; 
font-weight:500; 
}
    .header-actions { 
display:flex; 
gap:0.75rem; 
align-items:center; 
}

    .theme-toggle {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.15);
      color: rgba(255,255,255,0.9);
      width: 40px; 
height: 40px; 
border-radius:50%;
      display:flex; 
align-items:center; 
justify-content:center; 
cursor:pointer;
    }

    .user-info { 
display:flex; 
gap:0.6rem; 
align-items:center; 
color:white; 
}
    .user-avatar { 
width:40px; 
height:40px; 
border-radius:50%; 
background: rgba(255,255,255,0.15); 
display:flex; 
align-items:center; 
justify-content:center; 
font-weight:600; 
}

    /* ---------- Layout ---------- */
    .main-container {
      max-width: 1400px;
      margin: 1.5rem auto;
      padding: 0 1.25rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }

    .page-header {
      grid-column: 1 / -1;
      background: linear-gradient(135deg, var(--accent-blue), var(--accent-blue-hover));
      color: white;
      padding: 1.4rem;
      border-radius: 12px;
    }

    .card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 1rem;
      box-shadow: var(--shadow-sm);
    }

    .card-header { 
display:flex; 
justify-content:space-between; 
align-items:center; 
margin-bottom:1rem; 
}

    /* ---------- Calendar / Planner styles ---------- */
    .planner {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .calendar-header { 
display:flex; 
justify-content:space-between; 
align-items:center; 
gap:1rem; 
margin-bottom:0.5rem; 
}
    .month-nav { 
display:flex; 
gap:0.5rem; 
align-items:center; 
}
    .nav-btn { 
background:none; 
border:none; 
color:var(--text-secondary); 
cursor:pointer; 
padding:0.4rem; 
border-radius:6px; 
}
    .nav-btn:hover { 
color:var(--accent-blue); 
background:var(--bg-secondary); 
}

    .current-month { 
font-weight:700; 
color:var(--text-primary); 
}

    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 0.5rem;
    }

    .calendar-day-header { 
text-align:center; 
font-size:0.85rem; 
font-weight:700; 
color:var(--text-secondary); 
padding:0.45rem; 
}

    .calendar-day {
      min-height: 84px;
      border-radius: 10px;
      display:flex;
      flex-direction:column;
      gap:6px;
      padding:8px;
      border:1px solid var(--border-color);
      background: var(--bg-card);
      cursor:pointer;
      position:relative;
      transition: transform .12s ease, box-shadow .12s ease;
    }

    .calendar-day:hover { 
transform: translateY(-4px); 
box-shadow: var(--shadow-md); 
}

    .calendar-day .date-num { 
font-weight:600; 
align-self:flex-start; 
font-size:0.95rem; 
color:var(--text-primary); 
}
    .calendar-day .dot { 
width:8px; 
height:8px; 
border-radius:50%; 
background:var(--planner-dot); 
position:absolute; 
left:8px; 
top:8px; 
display:none; 
}
    .calendar-day.has-event { 
background: var(--planner-highlight); 
}
    .calendar-day.has-event .dot { 
display:block; 
}

    .today {
      outline: 2px solid var(--accent-yellow);
      outline-offset: -4px;
    }

    /* Modal (edit day) */
    .modal {
      position: fixed;
      inset: 0;
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1200;
    }

    .modal.show { 
display:flex; 
}
    .modal .overlay { 
position:absolute; 
inset:0; 
background: rgba(0,0,0,0.45); 
}

    .modal-content {
      position:relative;
      width: 420px;
      max-width: calc(100% - 32px);
      background: var(--bg-card);
      border-radius: 12px;
      padding: 1rem;
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow-lg);
      z-index: 1300;
    }

    .modal-content h3 { 
margin-bottom: 0.5rem; 
text-align:center; 
}
    .task-list { 
display:flex; 
flex-direction:column; 
gap:0.5rem; 
max-height:220px; 
overflow:auto; 
padding-right:4px; 
margin-bottom:0.6rem; 
}
    .task-row { 
display:flex; 
justify-content:space-between; 
gap:0.6rem; 
align-items:center; 
padding:0.55rem; 
border-radius:8px; 
background: var(--bg-secondary); 
border:1px dashed var(--border-color); 
}
    .task-row .meta { 
display:flex; 
gap:0.6rem; 
align-items:center; 
}
    .task-sub { 
background:var(--accent-blue); 
color:#fff; 
padding:0.18rem 0.45rem; 
border-radius:6px; 
font-size:0.82rem; 
}
    .task-desc { 
font-size:0.9rem; 
color:var(--text-secondary); 
}

    .modal-form { 
display:flex; 
flex-direction:column; 
gap:0.5rem; 
}
    .form-input, .form-select, .form-textarea {
      padding:0.6rem 0.8rem; 
border-radius:8px; 
border:1px solid var(--border-color); 
background:var(--bg-card); 
color:var(--text-primary);
    }
    .form-textarea { 
min-height:72px; 
resize:vertical; 
}

    .modal-actions { 
display:flex; 
gap:0.6rem; 
justify-content:flex-end; 
margin-top:0.6rem; 
}
    .btn { 
padding:0.55rem 0.8rem; 
border-radius:8px; 
border:none; 
cursor:pointer; 
font-weight:600; 
}
    .btn-primary { 
background:var(--accent-blue); 
color:#fff; 
}
    .btn-secondary { 
background:var(--bg-secondary); 
color:var(--text-secondary); 
border:1px solid var(--border-color); 
}

    /* responsive */
    @media (max-width: 1024px) {
      .main-container { 
grid-template-columns: 1fr; 
padding: 0 12px; 
}
    }

    footer {
    background: var(--bg-card);
    padding: 3rem 2rem 1rem;
    border-top: 1px solid var(--border-color);
}

.footer-content {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--accent-blue);
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-links a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: var(--accent-blue);
}

.copyright {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
    color: var(--text-secondary);
}


  </style>
</head>
<body>
        <!-- Menu Overlay -->
        <div class="menu-overlay" id="menuOverlay"></div>

        <header>
            <div class="header-container">
                <!-- Menu Toggle Button -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head_items.php'; ?>
            </div>
        </header>

        <!-- Navigation Menu (Sidebar) -->
        <nav class="nav-menu" id="navMenu">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/nav.php'; ?>
        </nav>

  <!-- Main -->
  <div class="main-container">
    <div class="page-header">
      <h1 class="page-title"><i class="fas fa-tasks"></i> المهام والواجبات</h1>
      <p class="page-subtitle">نظم مهامك وتابع جدولك الدراسي بكفاءة</p>
    </div>

    <!-- left column: existing tasks (keeps original style) -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list-check"></i> قائمة المهام</h3>
        <button class="btn btn-primary" id="openQuickAdd"><i class="fas fa-plus"></i> إضافة مهمة</button>
      </div>

      <div id="globalTasks" class="tasks-list">
        <!-- global upcoming tasks will be injected here -->
        <p style="color:var(--text-muted)">لا توجد مهام حالياً. اضغط على يوم في التقويم لإضافة مهام.</p>
      </div>
    </div>

    <!-- right column: planner -->
    <div class="card planner">
      <div class="calendar-header">
        <div class="month-nav">
          <button class="nav-btn" id="prevMonth"><i class="fas fa-chevron-right"></i></button>
          <div class="current-month" id="currentMonthLabel">أكتوبر 2025</div>
          <button class="nav-btn" id="nextMonth"><i class="fas fa-chevron-left"></i></button>
        </div>
        <div style="font-size:0.95rem; color:var(--text-secondary)">اضغطي على أي يوم لإضافة/عرض المواد والمهام</div>
      </div>

      <div class="calendar-grid" id="calendarGrid">
        <!-- day headers -->
        <div class="calendar-day-header">الأحد</div>
        <div class="calendar-day-header">الاثنين</div>
        <div class="calendar-day-header">الثلاثاء</div>
        <div class="calendar-day-header">الأربعاء</div>
        <div class="calendar-day-header">الخميس</div>
        <div class="calendar-day-header">الجمعة</div>
        <div class="calendar-day-header">السبت</div>
        <!-- date cells injected by JS -->
      </div>
    </div>
  </div>

  <!-- Modal for day (add / list tasks) -->
  <div class="modal" id="dayModal" aria-hidden="true">
    <div class="overlay" id="modalOverlay"></div>

    <div class="modal-content" role="dialog" aria-modal="true">
      <button id="closeModal" style="position:absolute; left:10px; top:8px; border:none; background:none; font-size:1.1rem; cursor:pointer;">
        <i class="fas fa-times"></i>
      </button>

      <h3 id="modalDateLabel">التاريخ</h3>

      <div class="task-list" id="modalTaskList">
        <!-- tasks for this date -->
      </div>

      <form id="addTaskForm" class="modal-form">
        <select id="taskSubject" class="form-select" required>
          <option value="">اختر المادة</option>
          <option>رياضيات</option>
          <option>فيزياء</option>
          <option>كيمياء</option>
          <option>أحياء</option>
          <option>عربي</option>
          <option>انجليزي</option>
          <option>تاريخ</option>
          <option>جغرافيا</option>
        </select>

        <textarea id="taskDesc" class="form-textarea" placeholder="تفاصيل المهمة (اختياري)"></textarea>

        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelAdd">إلغاء</button>
          <button type="submit" class="btn btn-primary">حفظ المهمة</button>
        </div>
      </form>
    </div>
  </div>

  <footer>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
  </footer>

  <script>





    /****************** Planner logic ******************/
    const monthLabel = document.getElementById('currentMonthLabel');
    const calendarGrid = document.getElementById('calendarGrid');
    const modal = document.getElementById('dayModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const closeModalBtn = document.getElementById('closeModal');
    const modalDateLabel = document.getElementById('modalDateLabel');
    const modalTaskList = document.getElementById('modalTaskList');
    const addTaskForm = document.getElementById('addTaskForm');
    const taskSubject = document.getElementById('taskSubject');
    const taskDesc = document.getElementById('taskDesc');
    const globalTasksEl = document.getElementById('globalTasks');
    const openQuickAdd = document.getElementById('openQuickAdd');

    const cancelAddBtn = document.getElementById('cancelAdd');

    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');

    const arabicMonths = ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];

    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let selectedDateISO = null;

    // tasks stored as object { "YYYY-MM-DD": [ {id, subject, desc} ] }
    let tasks = JSON.parse(localStorage.getItem('planner_tasks_v1') || '{}');

    // helper: zero pad
    function z(n){ return n < 10 ? '0'+n : ''+n; }
    function isoDate(y,m,d){ return y + '-' + z(m) + '-' + z(d); }

    function saveTasksStorage(){
      localStorage.setItem('planner_tasks_v1', JSON.stringify(tasks));
    }

    function renderCalendar(month, year){
      // update label
      monthLabel.textContent = arabicMonths[month] + ' ' + year;

      // clear previous days (keep headers)
      // remove all child nodes after the 7 header nodes
      while (calendarGrid.children.length > 7) calendarGrid.removeChild(calendarGrid.lastChild);

      // first weekday of month (0 = Sunday)
      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      // add empty placeholders for alignment
      for (let i=0; i<firstDay; i++){
        const empty = document.createElement('div');
        empty.className = 'calendar-day';
        empty.style.visibility = 'hidden';
        calendarGrid.appendChild(empty);
      }

      for (let d=1; d<=daysInMonth; d++){
        const cell = document.createElement('div');
        cell.className = 'calendar-day';
        const dateISO = isoDate(year, month+1, d);
        cell.dataset.date = dateISO;

        const dateNum = document.createElement('div');
        dateNum.className = 'date-num';
        dateNum.textContent = d;
        cell.appendChild(dateNum);

        // dot for tasks
        const dot = document.createElement('div');
        dot.className = 'dot';
        cell.appendChild(dot);

        // mark today
        const now = new Date();
        if (now.getFullYear() === year && now.getMonth() === month && now.getDate() === d){
          cell.classList.add('today');
        }

        // if tasks exist for this date, mark it
        if (tasks[dateISO] && tasks[dateISO].length > 0){
          cell.classList.add('has-event');
        }

        // click handler
        cell.addEventListener('click', () => {
          openDayModal(dateISO);
        });

        calendarGrid.appendChild(cell);
      }

      // fill trailing blanks to keep grid tidy (optional)
      const totalCells = calendarGrid.children.length - 7; // excluding headers
      const needed = (7*6) - totalCells;
      for (let k=0; k<needed; k++){
        const empty = document.createElement('div');
        empty.className = 'calendar-day';
        empty.style.visibility = 'hidden';
        calendarGrid.appendChild(empty);
      }

      renderGlobalTasksList();
    }

    // open modal for dateISO
    function openDayModal(dateISO){
      selectedDateISO = dateISO;
      // format date to Arabic: e.g. 25 أكتوبر 2025
      const parts = dateISO.split('-').map(x => parseInt(x,10));
      const y = parts[0], m = parts[1]-1, d = parts[2];
      modalDateLabel.textContent = `${d} ${arabicMonths[m]} ${y}`;
      taskSubject.value = '';
      taskDesc.value = '';

      renderModalTaskList(dateISO);

      modal.classList.add('show');
      modal.setAttribute('aria-hidden','false');
    }

    function closeDayModal(){
      modal.classList.remove('show');
      modal.setAttribute('aria-hidden','true');
      selectedDateISO = null;
    }

    function renderModalTaskList(dateISO){
      modalTaskList.innerHTML = '';
      const list = tasks[dateISO] || [];
      if (list.length === 0){
        modalTaskList.innerHTML = '<p style="color:var(--text-muted); text-align:center;">لا توجد مهام لهذا اليوم</p>';
        return;
      }

      list.forEach(t => {
        const row = document.createElement('div');
        row.className = 'task-row';

        const meta = document.createElement('div');
        meta.className = 'meta';

        const sub = document.createElement('div');
        sub.className = 'task-sub';
        sub.textContent = t.subject;

        const desc = document.createElement('div');
        desc.className = 'task-desc';
        desc.textContent = t.desc || '';

        meta.appendChild(sub);
        meta.appendChild(desc);

        const actions = document.createElement('div');
        actions.style.display = 'flex';
        actions.style.gap = '8px';
        actions.style.alignItems = 'center';

        const del = document.createElement('button');
        del.className = 'btn btn-secondary';
        del.textContent = 'حذف';
        del.addEventListener('click', () => {
          deleteTask(dateISO, t.id);
        });

        actions.appendChild(del);

        row.appendChild(meta);
        row.appendChild(actions);

        modalTaskList.appendChild(row);
      });
    }

    function addTask(dateISO, subject, desc){
      if (!tasks[dateISO]) tasks[dateISO] = [];
      const id = Date.now() + Math.floor(Math.random()*999);
      tasks[dateISO].push({ id, subject, desc });
      saveTasksStorage();
      // update calendar cell appearance
      const cell = document.querySelector(`.calendar-day[data-date="${dateISO}"]`);
      if (cell) cell.classList.add('has-event');
      renderModalTaskList(dateISO);
      renderGlobalTasksList();
    }

    function deleteTask(dateISO, id){
      if (!tasks[dateISO]) return;
      tasks[dateISO] = tasks[dateISO].filter(t => t.id !== id);
      if (tasks[dateISO].length === 0) delete tasks[dateISO];
      saveTasksStorage();
      // update UI
      const cell = document.querySelector(`.calendar-day[data-date="${dateISO}"]`);
      if (cell && (!tasks[dateISO] || tasks[dateISO].length === 0)) cell.classList.remove('has-event');
      renderModalTaskList(dateISO);
      renderGlobalTasksList();
    }

    // show all upcoming tasks in left column (simple list)
    function renderGlobalTasksList(){
      globalTasksEl.innerHTML = '';
      const all = [];
      Object.keys(tasks).sort().forEach(dateISO => {
        tasks[dateISO].forEach(t => {
          all.push({ dateISO, ...t });
        });
      });

      if (all.length === 0){
        globalTasksEl.innerHTML = '<p style="color:var(--text-muted)">لا توجد مهام حالياً. اضغطي على يوم في التقويم لإضافة مهام.</p>';
        return;
      }

      all.slice(0,20).forEach(item => {
        const row = document.createElement('div');
        row.className = 'task-item';
        row.style.display = 'flex';
        row.style.justifyContent = 'space-between';
        row.style.alignItems = 'center';
        row.style.padding = '0.6rem';
        row.style.borderRadius = '8px';
        row.style.marginBottom = '0.6rem';
        row.style.background = 'var(--bg-secondary)';

        const left = document.createElement('div');
        left.style.display = 'flex';
        left.style.flexDirection = 'column';
        left.style.gap = '4px';

        const title = document.createElement('div');
        title.style.fontWeight = '600';
        title.textContent = item.subject + ' — ' + formatDateHuman(item.dateISO);

        const desc = document.createElement('div');
        desc.style.fontSize = '0.9rem';
        desc.style.color = 'var(--text-secondary)';
        desc.textContent = item.desc || '';

        left.appendChild(title);
        left.appendChild(desc);

        const right = document.createElement('div');
        right.style.display = 'flex';
        right.style.flexDirection = 'column';
        right.style.gap = '6px';
        right.style.alignItems = 'flex-end';

        const goto = document.createElement('button');
        goto.className = 'btn btn-primary';
        goto.style.padding = '0.4rem 0.6rem';
        goto.innerHTML = '<i class="fas fa-arrow-left"></i> افتح';
        goto.addEventListener('click', () => {
          // open modal for that date
          openDayModal(item.dateISO);
        });

        right.appendChild(goto);

        row.appendChild(left);
        row.appendChild(right);

        globalTasksEl.appendChild(row);
      });
    }

    function formatDateHuman(iso){
      const p = iso.split('-').map(x=>parseInt(x,10));
      return `${p[2]}/${p[1]}/${p[0]}`;
    }

    // initial render
    renderCalendar(currentMonth, currentYear);

    // prev / next
    prevMonthBtn.addEventListener('click', () => {
      currentMonth--;
      if (currentMonth < 0){ currentMonth = 11; currentYear--; }
      renderCalendar(currentMonth, currentYear);
    });
    nextMonthBtn.addEventListener('click', () => {
      currentMonth++;
      if (currentMonth > 11){ currentMonth = 0; currentYear++; }
      renderCalendar(currentMonth, currentYear);
    });

    // modal handlers
    modalOverlay.addEventListener('click', closeDayModal);
    closeModalBtn.addEventListener('click', closeDayModal);
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('show')) closeDayModal();
    });

    // add task form submit
    addTaskForm.addEventListener('submit', (e) => {
      e.preventDefault();
      if (!selectedDateISO) return;
      const sub = taskSubject.value.trim();
      const desc = taskDesc.value.trim();
      if (!sub) { alert('اختاري المادة'); return; }
      addTask(selectedDateISO, sub, desc);
      taskSubject.value = '';
      taskDesc.value = '';
    });

    // quick add button (opens today)
    openQuickAdd.addEventListener('click', () => {
      const iso = isoDate(today.getFullYear(), today.getMonth()+1, today.getDate());
      openDayModal(iso);
    });

    // expose for debugging if needed (remove in production)
    window._planner = { tasks, renderCalendar, addTask, deleteTask };









      openQuickAdd.addEventListener('click', () => {
        const iso = isoDate(today.getFullYear(), today.getMonth()+1, today.getDate());
        openDayModal(iso);
      });

      cancelAddBtn.addEventListener('click', (e) => {
          e.preventDefault(); 
          closeDayModal();
      });

      window._planner = { tasks, renderCalendar, addTask, deleteTask };

  </script>
  <script src="/assets/scripts/script.js"></script>
</body>
</html>


