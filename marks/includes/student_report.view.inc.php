<?php

declare(strict_types=1);

function print_exams_table(array $exams_data) {
    if (empty($exams_data)) {
        echo '<tr><td colspan="5">No exams found for this student and subject.</td></tr>';
        return;
    }

    foreach ($exams_data as $exam) {
        // Calculate the percentage
        $highest_mark = (int) $exam['full_mark'];
        $student_mark = (int) $exam['student_mark'];
        
        $percent = 0;
        if ($highest_mark > 0) {
            $percent = round(($student_mark / $highest_mark) * 100, 2);
        }

        // Output the table row (<tr>) with data cells (<td>)
        echo '<tr>';
        
        // exam title
        echo '<td>' . htmlspecialchars($exam['exam_title']) . '</td>';
        
        // exam date
        // NOTE: You might want to format the date for display (e.g., date('d M Y', strtotime($exam['exam_date'])))
        echo '<td>' . htmlspecialchars($exam['exam_date']) . '</td>'; 
        
        // full mark (highest_mark)
        echo '<td>' . $highest_mark . '</td>';
        
        // student mark
        echo '<td>' . $student_mark . '</td>';
        
        // percent
        echo '<td>' . $percent . '%</td>';
        
        echo '</tr>';
    }
}

/**
 * Checks the URL for an 'error' parameter and displays a corresponding message.
 * This should be called on the page where the user lands after a failed action (e.g., add_exam.php).
 * * @return void Prints the HTML for the error message directly.
 */
function display_error_message() {
    // Check if the 'error' parameter exists in the URL
    if (!isset($_GET['error'])) {
        return;
    }

    // Sanitize the input to prevent XSS (Cross-Site Scripting)
    $error_code = htmlspecialchars($_GET['error']);
    $message = '';
    
    // Determine the user-friendly message based on the error code
    switch ($error_code) {
        case 'empty_input':
            $message = '⚠️ الرجاء ملء جميع الحقول المطلوبة لإضافة العلامة.'; // Please fill in all required fields to add the mark.
            break;
        case 'insert_failed':
            $message = '❌ فشل إدخال العلامة في قاعدة البيانات. يرجى المحاولة مرة أخرى.'; // Failed to insert the mark into the database. Please try again.
            break;
        case 'db_error':
            $message = '🚨 حدث خطأ غير متوقع في النظام. يرجى الاتصال بالدعم الفني.'; // An unexpected system error occurred. Please contact technical support.
            break;
        case 'invalid_data':
            $message = '🚫 البيانات المدخلة غير صحيحة (علامة الطالب أكبر من العلامة القصوى).'; // The entered data is incorrect (e.g., student mark is greater than the highest mark).
            break;
        default:
            $message = '❌ حدث خطأ غير معروف.'; // An unknown error occurred.
            break;
    }

    // Output the error message in a styled div
    if (!empty($message)) {
        echo '<div style="background-color: #fdd; border: 1px solid #f99; padding: 10px; margin-bottom: 15px; border-radius: 5px; color: #a00;">';
        echo $message;
        echo '</div>';
    }
}