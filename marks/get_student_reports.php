<?php

// إعداد الرأس لضمان إرجاع JSON
header ( 'Content-Type: application/json' ) ;

// يجب تضمين ملفات الجلسة والاتصال بقاعدة البيانات (افترض وجودها)
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ; // يجب أن يوفر هذا $pdo
// للبيئة التجريبية، سنفترض وجود الجلسة ومعرف الطالب و$pdo
if ( ! isset ( $_SESSION[ 'student_id' ] ) || ! isset ( $pdo ) ) {
    // يمكنك استبدال هذا بمنطق التحقق من الصلاحية والوصول الحقيقي
    http_response_code ( 403 ) ;
    echo json_encode ( [ 'error' => 'Unauthorized access or missing student ID.' ] ) ;
    exit () ;
}

$student_id = $_SESSION[ 'student_id' ] ;
 
$report_data = [
    'studentName' => 'اسم الطالب الافتراضي' , // سيتم تحديثه لاحقًا
    'overallGrade' => 0 ,
    'totalExams' => 0 ,
    'exams' => [] ,
    'behaviour' => [] ,
    'absence' => [] ,
] ;

try {
    // 1. جلب اسم الطالب (افتراض أن جدول users/students متاح)
    // يُرجى تعديل هذا الاستعلام حسب هيكل قاعدة بياناتك الفعلي
    $query = "SELECT fullname FROM students WHERE id = :student_id;" ;
    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ':student_id' , $student_id ) ;
    $stmt -> execute () ;
    $user_result = $stmt -> fetch ( PDO :: FETCH_ASSOC ) ;

    if ( $user_result ) {
        $report_data[ 'studentName' ] = htmlspecialchars ( $user_result[ 'fullname' ] ) ;
    }

    // 2. جلب سجل الامتحانات وحساب المعدل العام
    $query_exams = "SELECT subject, exam_title, exam_date, student_mark, full_mark 
                    FROM exams 
                    WHERE student_id = :student_id
                    ORDER BY exam_date DESC;" ;
    $stmt_exams = $pdo -> prepare ( $query_exams ) ;
    $stmt_exams -> bindParam ( ':student_id' , $student_id ) ;
    $stmt_exams -> execute () ;
    $exams_results = $stmt_exams -> fetchAll ( PDO :: FETCH_ASSOC ) ;

    $total_marks = 0 ;
    $total_full_marks = 0 ;

    foreach ( $exams_results as $exam ) {
        $total_marks += ( int ) $exam[ 'student_mark' ] ;
        $total_full_marks += ( int ) $exam[ 'full_mark' ] ;
        $report_data[ 'exams' ][] = [
            'subject' => htmlspecialchars ( $exam[ 'subject' ] ) ,
            'title' => htmlspecialchars ( $exam[ 'exam_title' ] ) ,
            'date' => $exam[ 'exam_date' ] ,
            'studentMark' => ( int ) $exam[ 'student_mark' ] ,
            'fullMark' => ( int ) $exam[ 'full_mark' ] ,
        ] ;
    }

    // حساب المعدل العام
    if ( $total_full_marks > 0 ) {
        $report_data[ 'overallGrade' ] = round ( ( $total_marks / $total_full_marks ) * 100 ) ;
    }
    $report_data[ 'totalExams' ] = count ( $exams_results ) ;

    // 3. جلب سجل السلوك
    // يجب دمج هذا الاستعلام مع جدول المعلمين (teachers) لجلب اسم المعلم
    $query_behaviour = "SELECT b.behaviour_type, b.behaviour_notes, b.behaviour_date, t.fullname AS teacher_name
                        FROM behaviour b
                        JOIN teachers t ON b.teacher_id = t.id
                        WHERE b.student_id = :student_id
                        ORDER BY b.behaviour_date DESC;" ;
    $stmt_behaviour = $pdo -> prepare ( $query_behaviour ) ;
    $stmt_behaviour -> bindParam ( ':student_id' , $student_id ) ;
    $stmt_behaviour -> execute () ;

    foreach ( $stmt_behaviour -> fetchAll ( PDO :: FETCH_ASSOC ) as $behaviour ) {
        $report_data[ 'behaviour' ][] = [
            'type' => htmlspecialchars ( $behaviour[ 'behaviour_type' ] ) ,
            'notes' => htmlspecialchars ( $behaviour[ 'behaviour_notes' ] ) ,
            'date' => $behaviour[ 'behaviour_date' ] ,
            'teacher' => htmlspecialchars ( $behaviour[ 'teacher_name' ] ) ,
        ] ;
    }

    // 4. جلب سجل الغياب
    // يجب دمج هذا الاستعلام مع جدول المعلمين (teachers) لجلب اسم المعلم
    $query_absence = "SELECT a.*, t.fullname AS teacher_name
                      FROM absence a
                      JOIN teachers t ON a.teacher_id = t.id
                      WHERE a.student_id = :student_id
                      ORDER BY a.absence_date DESC;" ;
    $stmt_absence = $pdo -> prepare ( $query_absence ) ;
    $stmt_absence -> bindParam ( ':student_id' , $student_id ) ;
    $stmt_absence -> execute () ;

    foreach ( $stmt_absence -> fetchAll ( PDO :: FETCH_ASSOC ) as $absence ) {
        // نستخدم ملاحظات الغياب كنوع سلوك في العرض
        $report_data[ 'absence' ][] = [
            'type' => "غياب" ,
            'notes' => htmlspecialchars ( $absence[ 'notes' ] ) ,
            'date' => $absence[ 'absence_date' ] ,
            'teacher' => htmlspecialchars ( $absence[ 'teacher_name' ] ) ,
        ] ;
    }


    // إرجاع البيانات بتنسيق JSON
    echo json_encode ( $report_data ) ;
} catch ( PDOException $e ) {
    // في حال حدوث خطأ في قاعدة البيانات
    http_response_code ( 500 ) ;
    echo json_encode ( [ 'error' => 'Database error: ' . $e -> getMessage () ] ) ;
} catch ( Exception $e ) {
    // في حال وجود خطأ عام
    http_response_code ( 500 ) ;
    echo json_encode ( [ 'error' => 'Server error: ' . $e -> getMessage () ] ) ;
}
?>
