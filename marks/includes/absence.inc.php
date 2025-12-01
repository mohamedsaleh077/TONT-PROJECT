<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";

require_once "absence.model.inc.php"; // افترض أن دالة insert_absence هنا

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. استرجاع البيانات
    $student_id   = $_SESSION['student_id'];
    $absence_date = $_POST["absence_date"] ?? null;
    $notes = $_POST["notes"] ?? null;

    // 2. استرجاع معرف المعلم من الجلسة
    $teacher_id   = $_SESSION["ref_id"];
    

    try {
        // 4. تنفيذ دالة الإدراج
        $result = insert_absence(
            $pdo,
            (int)$student_id,
            (int)$teacher_id,
            $absence_date,
            $notes
        );

        // 5. التوجيه بناءً على النتيجة
        if ($result === true) {
            header("Location: ../teacher_editor.php?id=" . $student_id . "&success=absence_added");
        } else {
            // فشل الإدراج غير المتعلق بـ PDO
            header("Location: ../teacher_editor.php?id=" . $student_id . "&error=insert_failed");
        }
       
        $pdo = null;
        die();
        
    } catch (PDOException $e) {
        // خطأ قاعدة البيانات
        error_log("Absence Query Failed: " . $e->getMessage());
        header("Location: ../teacher_editor.php?id=" . $student_id . "&error=db_error");
        die();
    }
} else {
    header("Location: /index.php");
    die();
}