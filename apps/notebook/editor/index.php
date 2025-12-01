<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/head.php'; ?>
  <title>ملاحظاتي - تحرير الملاحظة</title>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="mobile.css">
</head>

<body>

  <!-- Header -->
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

  <!-- Editor Container -->
  <div class="editor-container">
    <!-- Editor Header -->
    <div class="editor-header">
      <a href="../notes/index.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
        العودة الى الملاحظات
      </a>
      <input type="text" class="note-title-input" placeholder="Note Title" id="note-name">
      <div class="note-actions">
        <a href="../notes/index.php">
          <button class="btn btn-outline">
            <i class="fas fa-times"></i>
            الغاء
          </button>
        </a>
        <button class="btn btn-primary" id="save-btn">
          <i class="fas fa-save"></i>
          حفظ الملاحظة
        </button>
      </div>
    </div>

    <!-- Formatting Toolbar -->
    <div class="formatting-toolbar">
      <div class="toolbar-group">
        <button class="toolbar-button" title="Bold" onclick="formatText('bold')">
          <i class="fas fa-bold"></i>
        </button>
        <button class="toolbar-button" title="Italic" onclick="formatText('italic')">
          <i class="fas fa-italic"></i>
        </button>
        <button class="toolbar-button" title="Underline" onclick="formatText('underline')">
          <i class="fas fa-underline"></i>
        </button>
      </div>

      <div class="toolbar-group">
        <button class="toolbar-button" title="Bullet List" onclick="formatText('insertUnorderedList')">
          <i class="fas fa-list-ul"></i>
        </button>
        <button class="toolbar-button" title="Numbered List" onclick="formatText('insertOrderedList')">
          <i class="fas fa-list-ol"></i>
        </button>
      </div>

      <div class="toolbar-group">
        <button class="toolbar-button" title="Align Left" onclick="formatText('justifyLeft')">
          <i class="fas fa-align-left"></i>
        </button>
        <button class="toolbar-button" title="Align Center" onclick="formatText('justifyCenter')">
          <i class="fas fa-align-center"></i>
        </button>
        <button class="toolbar-button" title="Align Right" onclick="formatText('justifyRight')">
          <i class="fas fa-align-right"></i>
        </button>
      </div>

      <div class="toolbar-group">
        <button class="toolbar-button" title="Insert Link" onclick="insertLink()">
          <i class="fas fa-link"></i>
        </button>
        <button class="toolbar-button" title="Insert Image" onclick="insertImage()">
          <i class="fas fa-image"></i>
        </button>
      </div>

      <div class="toolbar-group">
        <button class="toolbar-button" title="Undo" onclick="document.execCommand('undo', false)">
          <i class="fas fa-undo"></i>
        </button>
        <button class="toolbar-button" title="Redo" onclick="document.execCommand('redo', false)">
          <i class="fas fa-redo"></i>
        </button>
      </div>
    </div>

    <!-- Note Editor Area -->
    <div class="note-editor">
      <div class="editor-content" contenteditable="true" id="user-notes">
      </div>
    </div>

    <!-- Editor Status Bar -->
    <div class="editor-status">
      <div class="word-count">
        <i class="fas fa-font"></i>
        <span id="word-count">0 كلمة</span>
        <span id="char-count">0 حرف</span>
      </div>
      <!-- <div class="autosave-status"> -->
      <!-- <i class="fas fa-save"></i> -->
      <!-- <span>All changes saved</span> -->
      <!-- </div> -->
    </div>
  </div>

  <script src="editor.js"></script>
  <script src="../logic/main.js"></script>

  
  <script src="/assets/scripts/script.js"></script>
</body>

</html>