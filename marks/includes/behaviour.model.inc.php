<?php

declare(strict_types=1);

/**
 * إدراج سجل سلوك جديد للطالب في قاعدة البيانات.
 * * @param PDO $pdo كائن اتصال قاعدة البيانات.
 * @param int $student_id معرف الطالب.
 * @param int $teacher_id معرف المعلم الذي سجل السلوك.
 * @param string $behaviour_type نوع السلوك (مثال: إيجابي - تعاون).
 * @param string $behaviour_notes ملاحظات/وصف السلوك التفصيلي.
 * @param string $behaviour_date تاريخ حدوث السلوك بصيغة 'YYYY-MM-DD'.
 * @return bool نجاح أو فشل العملية.
 */
function insert_behaviour(PDO $pdo, int $student_id, int $teacher_id, string $behaviour_type, string $behaviour_notes, string $behaviour_date): bool {
    
    // الاستعلام الجديد يتطابق مع جدول behaviour تماماً
    $query = "INSERT INTO behaviour 
             (student_id, teacher_id, behaviour_type, behaviour_notes, behaviour_date) 
             VALUES 
             (:student_id, :teacher_id, :behaviour_type, :behaviour_notes, :behaviour_date)";

    try {
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindParam(":teacher_id", $teacher_id, PDO::PARAM_INT);
        $stmt->bindParam(":behaviour_type", $behaviour_type, PDO::PARAM_STR);
        $stmt->bindParam(":behaviour_notes", $behaviour_notes, PDO::PARAM_STR);
        $stmt->bindParam(":behaviour_date", $behaviour_date, PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Database Error inserting behaviour: " . $e->getMessage());
        return false;
    }
}


/**
 * استرجاع جميع سجلات السلوك لطالب محدد.
 * * يتم الانضمام لجدول المعلمين (teachers) للحصول على اسم المعلم المُسجّل.
 * * @param PDO $pdo كائن اتصال قاعدة البيانات.
 * @param int $student_id معرف الطالب.
 * @return array قائمة بسجلات السلوك.
 */
function list_student_behaviours(PDO $pdo, int $student_id): array {
    $query = "
        SELECT 
            b.behaviour_type, 
            b.behaviour_notes, 
            b.behaviour_date,
            t.fullname AS teacher_name
        FROM behaviour AS b
        INNER JOIN teachers AS t ON b.teacher_id = t.id
        WHERE b.student_id = :student_id
        ORDER BY b.behaviour_date DESC;
    ";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error listing behaviours: " . $e->getMessage());
        return [];
    }
}
