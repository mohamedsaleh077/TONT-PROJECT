<?php

declare(strict_types=1);


/**
 * استرجاع جميع تواريخ غياب طالب محدد.
 *
 * @param PDO $pdo كائن اتصال قاعدة البيانات.
 * @param int $student_id معرف الطالب.
 * @return array قائمة بصفوف الغياب.
 */
function list_absence_dates($pdo, $student_id) {
    $query = "
        SELECT * 
        FROM absence 
        WHERE student_id = :student_id 
        ORDER BY absence_date DESC;
    ";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error listing absence: " . $e->getMessage());
        return [];
    }
}

/**
 * طباعة تواريخ الغياب في صفوف جدول HTML.
 *
 * @param array $absence_data قائمة بصفوف الغياب المسترجعة من قاعدة البيانات.
 * @return void تطبع مباشرة إلى المخرج.
 */
function print_absence_table_rows(array $absence_data) {
    if (empty($absence_data)) {
        echo '<tr><td colspan="1">لا توجد سجلات غياب لهذا الطالب.</td></tr>';
        return;
    }

    foreach ($absence_data as $absence) {
        // تنسيق التاريخ ليكون أكثر قراءة
        $formatted_date = date('Y-m-d', strtotime($absence['absence_date']));
        
        echo '<tr>';
        
        // تاريخ الغياب
        echo '<td>' . htmlspecialchars($formatted_date) . '</td>';
echo '<td>' . htmlspecialchars(
    !empty($absence['notes']) 
        ? $absence['notes'] 
        : 'لم يتم تسجيل أي ملاحظات'
) . '</td>';        
        echo '</tr>';
    }
}