<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/input_validation.inc.php" ;

    // These names MUST match the 'name' attributes in the HTML form
    $school_id = $_POST[ "school_id" ] ;
    $fullname = $_POST[ "fullname" ] ;
    $grade = $_POST[ 'grade' ] ;
    $student_nation_id = $_POST[ 'student_nation_id' ] ;
    $parent_nation_id = $_POST[ 'parent_nation_id' ] ;

    $errors = [] ;
    if ( all_empty ( [ $fullname , $grade , $student_nation_id , $parent_nation_id ] ) ) {
        $errors[] = "مفيش بيانات دخلت" ;
    }

    if ( longer_than_255 ( $fullname ) ) {
        $errors[] = "الاسم اطول من 255 حرف" ;
    }

    if ( nation_id_invalid ( $student_nation_id ) ||
            nation_id_invalid ( $parent_nation_id ) ) {
        $errors[] = "الرقم القومي مش صحيح" ;
    }

    if ( invalid_grade ( $grade ) ) {
        $errors[] = "المرجله لازم بين 1 و 12 بس" ;
    }

    if ( is_invalid_id ( $school_id ) ) {
        $errors[] = "انت دخلت كود مدرسة غلط" ;
    }

    if ( empty ( $errors ) && is_nation_id_globally_used ( $pdo , $student_nation_id ) ) {
        $errors[] = "هذا الرقم القومي مستخدم بالفعل كولي أمر، أو كطالب، أو كمعلم." ;
    }

    if ( $errors ) {
        $_SESSION[ 'err' ] = $errors ;
        header ( "Location: ../index.php?err=yes" ) ;
        die () ;
    } else {

        // First, find the parent's ID securely
        $query_parent = "SELECT id FROM parents WHERE nation_id = :parent_nation_id;" ;
        $stmt_parent = $pdo -> prepare ( $query_parent ) ;
        $stmt_parent -> bindParam ( ':parent_nation_id' , $parent_nation_id ) ;
        $stmt_parent -> execute () ;
        $parent_id = $stmt_parent -> fetchColumn () ;
        $stmt_parent = NULL ;

        $query_student = "INSERT INTO students (school_id, fullname, grade,student_nation_id, parent_id) "
                . "VALUES (:school_id, :fullname, :grade, :student_nation_id, :parent_id);" ;
        $stmt_student = $pdo -> prepare ( $query_student ) ;

        $stmt_student -> bindParam ( ":school_id" , $school_id ) ;
        $stmt_student -> bindParam ( ":fullname" , $fullname ) ;
        $stmt_student -> bindParam ( ":grade" , $grade ) ;
        $stmt_student -> bindParam ( ":student_nation_id" , $student_nation_id ) ;
        $stmt_student -> bindParam ( ":parent_id" , $parent_id ) ;

        $stmt_student -> execute () ;

        $stmt_student = null ;
        $pdo = null ;

        header ( "Location: ../index.php" ) ;
        exit () ;
    }
} else {
    header ( "Location: /index.php" ) ;
    exit () ;
}    