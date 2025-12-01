<?php

declare(strict_types=1);


/**
 * إدراج سجل غياب جديد للطالب في قاعدة البيانات.
 *
 * @param PDO $pdo كائن اتصال قاعدة البيانات.
 * @param int $student_id معرف الطالب.
 * @param int|null $teacher_id معرف المعلم الذي سجل الغياب (يمكن أن يكون NULL).
 * @param string $absence_date تاريخ الغياب بصيغة 'YYYY-MM-DD'.
 * @return bool نجاح أو فشل العملية.
 */
function insert_absence($pdo, $student_id, $teacher_id, $absence_date, $notes) {
    $query = "INSERT INTO absence 
              (student_id, teacher_id, absence_date, notes) 
              VALUES 
              (:student_id, :teacher_id, :absence_date, :notes)";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        
        $stmt->bindParam(":teacher_id", $teacher_id, PDO::PARAM_INT);
        $stmt->bindParam(":absence_date", $absence_date, PDO::PARAM_STR);
        $stmt->bindParam(":notes", $notes, PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        // يمكنك تسجيل الخطأ هنا
        error_log("Database Error inserting absence: " . $e->getMessage());
        return false;
    }
}