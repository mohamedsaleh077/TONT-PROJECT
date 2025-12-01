<?php

declare(strict_types = 1) ;

function check_nation_id ( object $pdo , string $nation_id ) {
    $query = "
    SELECT 'parent' AS entity_type, id AS ref_id FROM parents WHERE nation_id = :nationIdInput
    UNION ALL
    SELECT 'student' AS entity_type, id AS ref_id FROM students WHERE student_nation_id = :nationIdInput
    UNION ALL
    SELECT 'teacher' AS entity_type, id AS ref_id FROM teachers WHERE nation_id = :nationIdInput
    " ;

    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ':nationIdInput' , $nation_id ) ;
    $stmt -> execute () ;

    $resulte = $stmt -> fetch ( PDO :: FETCH_ASSOC ) ;

    return $resulte ;
}

function get_account_created ( object $pdo , string $nation_id ) {
    $query = "SELECT id FROM users WHERE nation_id = :nation_id;" ;
    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ':nation_id' , $nation_id ) ;
    $stmt -> execute () ;

    $resulte = $stmt -> fetchColumn () ;

    return $resulte ;
}

function check_role_nation_id_exists ( object $pdo , string $nation_id , string $role ): bool
{
    $tableName = '';
    $idColumn = 'nation_id';
    switch ( strtolower( $role ) ) {
        case 'teacher':
            $tableName = 'teachers';
            break;
        case 'student':
            $tableName = 'students';
            $idColumn = 'student_nation_id';
            break;
        case 'parent':
            $tableName = 'parents';
            break;
        default:
            return false;
    }

    $query = "SELECT '{$tableName}' AS found_in_table FROM {$tableName} WHERE {$idColumn} = :nation_id LIMIT 1";
    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ":nation_id" , $nation_id ) ;
    $stmt -> execute () ;

    $result = $stmt->fetchColumn();
    return (bool)$result;
}

function get_user_details_by_nation_id(object $pdo, string $nation_id, string $role): array|false 
{
    // ملاحظة: تم تعديل الدالة لاستقبال $role و $ref_id كباراميترات
    // بدلاً من محاولة استخراجها من متغير static_data غير معرّف.

    $query = match ( $role ) {
        'student' =>
            // يتم الانضمام لجدول المدارس للحصول على الاسم
            "SELECT 
                s.fullname, 
                s.student_nation_id, 
                s.id AS ref_id, 
                s.school_id, 
                schools.school_name, 
                s.grade, 
                NULL AS subject
            FROM students AS s
            INNER JOIN schools ON s.school_id = schools.id
            WHERE s.student_nation_id = :nation_id;",

        'parent' =>
            // لا يحتاج لـ JOIN
            "SELECT 
                p.fullname, 
                p.nation_id, 
                p.id AS ref_id, 
                NULL AS school_id, 
                NULL AS subject
            FROM parents AS p
            WHERE p.nation_id = :nation_id;",

        'teacher' =>
            // يتم الانضمام لجدول المدارس للحصول على الاسم
            "SELECT 
                t.fullname, 
                t.nation_id, 
                t.id AS ref_id, 
                t.school_id, 
                schools.school_name, 
                t.subject
            FROM teachers AS t
            INNER JOIN schools ON t.school_id = schools.id
            WHERE t.nation_id = :nation_id;"
    };

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":nation_id", $nation_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $details = $stmt->fetch(PDO::FETCH_ASSOC);

        return $details;

    } catch (PDOException $e) {
        error_log("Database Query Failed: " . $e->getMessage());
        return false;
    }
}