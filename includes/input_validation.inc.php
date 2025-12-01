<?php

declare(strict_types = 1) ;

// ================= global validation ================
// for better error handler, we can later make it return an array with errors
// and marge all errors arrays and setup the better error handling (future feature)
// 
// htmlspecialchars
function safe ( $data ): string {
    return htmlspecialchars ( ( string ) ( $data ?? '' ) , ENT_QUOTES , 'UTF-8' ) ;
}

// CSRF
function is_CSRF_invalid ( $token ) {
    if ( ! ( $_SESSION[ "CSRF_TOKEN" ] === $token ) ) {
        return true ;
    } else {
        return false ;
    }
}

// protect the insert for IDs 
function is_invalid_id ( string $input_id ): bool {
    // check if not number
    if ( ! ctype_digit ( $input_id ) ) {
        return true ;
    }

    // check if it is less than ZERO
    if ( ( int ) $input_id <= 0 ) {
        return true ;
    }

    return false ;
}

// validate if input in this array of values (replacement for ENUM in SQL
function not_in_array ( array $input_fields , array $valid_array ): bool {
    foreach ( $input_fields as $field ) {
        if ( ! in_array ( $field , $valid_array ) ) {
            return true ;
        }
    }
    return false ;
}

// validation for inputs
function all_empty ( array $required_fields ): bool {
    // recieve array with all inputs in an array to validate for any empty input
    foreach ( $required_fields as $field ) {
        if ( empty ( $field ) ) {
            return true ;
        }
    }
    return false ;
}

function longer_than_255 ( $input_fields ): bool {
    foreach ( $input_fields as $field ) {
        if ( mb_strlen ( $field ) > 255 ) {
            return true ;
        }
    }
    return false ;
}

function longer_than_50 ( $input_fields ): bool {
    foreach ( $input_fields as $field ) {
        if ( mb_strlen ( $field ) > 50 ) {
            return true ;
        }
    }
    return false ;
}

function invalid_grade ( $input_fields ): bool {
    if ( ! ctype_digit ( $input_fields ) ) {
        return true ;
    }

    if ( ( int ) $input_fields > 12 || ( int ) $input_fields < 0 ) {
        return true ;
    }

    return false ;
}

// should be seperated to another file but when the project being extended more
function nation_id_invalid ( string $input_fields ): bool {
    if ( strlen ( $input_fields ) !== 14 ) {
        return true ;
    }
    if ( ! ctype_digit ( $input_fields ) ) {
        return true ;
    }
    return false ;
}

function password_short ( string $input_fields ): bool {
    if ( mb_strlen ( $input_fields ) < 8 ) {
        return true ;
    }
    return false ;
}

function email_invalid ( string $input_fields ): bool {
    if ( ! filter_var ( $input_fields , FILTER_VALIDATE_EMAIL ) ) {
        return true ;
    }
    return false ;
}

////////
// =================== for students reports ===============
// should be seperated to another file but when the project being extended more

function date_invalid ( string $input_date ): bool {
    $format = 'Y-m-d' ;

    $date_object = DateTime :: createFromFormat ( $format , $input_date ) ;

    if ( ! $date_object || $date_object -> format ( $format ) !== $input_date ) {
        return true ;
    }

    return false ;
}

function marks_invalid ( string $full_mark , string $student_mark ): bool {
    // check if only numbers
    if ( ! is_numeric ( $full_mark ) || ! is_numeric ( $student_mark ) ) {
        return true ;
    }

    $full = ( int ) $full_mark ;
    $student = ( int ) $student_mark ;

    // check that fullmark is always bigger than student mark or equal it
    if ( $student > $full ) {
        return true ;
    }

    // check if either both numbers not ZEROs
    if ( $full < 0 || $student < 0 ) {
        return true ;
    }

    // check if either both numbers not longer than 3 chars
    if ( $full > 999 || $student > 999 ) {
        return true ;
    }

    return false ;
}

// ================== for demo setup only ===============
// instead of creating new file for it only i will use this instead
/**
 * التحقق مما إذا كان الرقم القومي مسجلاً بالفعل في أي من الجداول
 * (parents, students, teachers) لضمان عدم تكرار الرقم القومي عبر الأدوار.
 * * * @param object $pdo كائن اتصال PDO بقاعدة البيانات.
 * @param string $nation_id الرقم القومي المراد التحقق منه.
 * @return bool true إذا كان الرقم القومي مستخدماً في أي جدول، false خلاف ذلك.
 */
function is_nation_id_globally_used ( object $pdo , string $nation_id ): bool {
    try {
        // نستخدم استعلام UNION ALL للبحث في الجداول الثلاثة دفعة واحدة.
        // يتم تعديل اسم العمود لكل جدول وفقاً لتعريفاتك (nation_id أو student_nation_id).
        $query = "
            (SELECT 1 FROM parents WHERE nation_id = :nation_id LIMIT 1)
            UNION ALL
            (SELECT 1 FROM students WHERE student_nation_id = :nation_id LIMIT 1)
            UNION ALL
            (SELECT 1 FROM teachers WHERE nation_id = :nation_id LIMIT 1)
            LIMIT 1;
        " ;
        $stmt = $pdo -> prepare ( $query ) ;
        $stmt -> bindParam ( ":nation_id" , $nation_id ) ;
        $stmt -> execute () ;

        // إذا كانت الدالة fetchColumn() تُرجع قيمة > 0، فهذا يعني أن هناك سجلًا مطابقًا في جدول واحد على الأقل.
        return $stmt -> fetchColumn () > 0 ;
    } catch ( PDOException $e ) {
        // يجب تسجيل هذا الخطأ وعدم عرضه في بيئة الإنتاج.
        error_log ( "DB Error checking global Nation ID usage: " . $e -> getMessage () ) ;
        // في حالة وجود خطأ في قاعدة البيانات، نفترض عدم استخدامه مؤقتاً لتجنب إيقاف التطبيق.
        return false ;
    }
}

// ====================== show errors global message ============
function show_errors ( $err_array = []) {
    if ( $err_array ) {
        echo '<div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0; border: 1px solid #f5c6cb;">' ;
        echo '<strong>الأخطاء:</strong><br>' ;

        foreach ( $err_array as $error ) {
            echo '- ' . htmlspecialchars ( $error ) . '<br>' ;
        }
        echo '</div>' ;

        unset ( $err_array ) ;
    }
}
