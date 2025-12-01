<?php

declare(strict_types=1);

/**
 * طباعة سجلات السلوك في صفوف جدول HTML.
 * * تفترض أن البيانات المستلمة تحتوي على الأعمدة:
 * behaviour_date, behaviour_type, behaviour_notes, teacher_name
 *
 * @param array $behaviour_data قائمة بسجلات السلوك.
 * @return void تطبع مباشرة إلى المخرج.
 */
function print_behaviour_table_rows(array $behaviour_data) {
    if (empty($behaviour_data)) {
        echo '<tr><td colspan="4" style="text-align: center;">لا توجد سجلات سلوك مسجلة لهذا الطالب.</td></tr>';
        return;
    }

    foreach ($behaviour_data as $behaviour) {
        
        // تنسيق التاريخ
        $formatted_date = date('Y-m-d', strtotime($behaviour['behaviour_date']));
        
        echo '<tr>';
        
        // 1. التاريخ
        echo '<td>' . htmlspecialchars($formatted_date) . '</td>';
        
        // 2. نوع السلوك
        echo '<td>' . htmlspecialchars($behaviour['behaviour_type']) . '</td>';
        
        // 3. وصف السلوك / الملاحظات (استخدام nl2br لعرض فواصل الأسطر)
        $notes_html = nl2br(htmlspecialchars($behaviour['behaviour_notes']));
        echo '<td>' . $notes_html . '</td>';
        
        // 4. المعلم المُسجل (تم جلبه عبر JOIN)
        echo '<td>' . htmlspecialchars($behaviour['teacher_name'] ?? 'غير معروف') . '</td>';
        
        echo '</tr>';
    }
}
