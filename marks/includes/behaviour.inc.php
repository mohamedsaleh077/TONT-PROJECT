<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";
require_once "behaviour.model.inc.php"; // الدالة insert_behaviour

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. استرجاع البيانات - اعتماداً على الحقول المخفية
    $student_id = $_POST["student_id"] ?? null;
    $teacher_id = $_SESSION["ref_id"]; // المعلم من الفورم المخفي أو الجلسة
    
    $behaviour_type  = $_POST["behaviour_type"] ?? null;
    $behaviour_notes = $_POST["behaviour_notes"] ?? null; // أصبح behaviour_notes
    $behaviour_date  = $_POST["behaviour_date"] ?? null;

    // 2. التحقق من البيانات الأساسية
    if (empty($student_id) || empty($teacher_id) || empty($behaviour_type) || empty($behaviour_date)) {
         header("Location: ../teacher_editor.php?id=" . $student_id . "&error=empty_input");
         die();
    }
    
    try {
        // 3. تنفيذ دالة الإدراج
        // نستخدم behaviour_notes مباشرة بدلاً من دمجها مع النوع
        $result = insert_behaviour(
            $pdo,
            (int)$student_id,
            (int)$teacher_id,
            $behaviour_type,
            $behaviour_notes,
            $behaviour_date
        );

        // 4. التوجيه بناءً على النتيجة
        if ($result === true) {
            header("Location: ../teacher_editor.php?id=" . $student_id . "&success=behaviour_added");
        } else {
            header("Location: ../teacher_editor.php?id=" . $student_id . "&error=insert_failed");
        }
        
        $pdo = null;
        die();
        
    } catch (PDOException $e) {
        error_log("Behaviour Query Failed: " . $e->getMessage());
        header("Location: ../teacher_editor.php?id=" . $student_id . "&error=db_error");
        die();
    }
} else {
    header("Location: /index.php");
    die();
}
