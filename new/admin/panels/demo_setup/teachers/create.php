<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/input_validation.inc.php" ;

    $fullname = $_POST[ "fullname" ] ;
    $school_id = $_POST[ "school_id" ] ;
    $subject = $_POST[ "subject" ] ;
    $nation_id = $_POST[ "teacher_nation_id" ] ;

    $errors = [] ;

    // التحقق من القيم الفاضية
    if ( all_empty ( [ $fullname , $school_id , $subject , $nation_id ] ) ) {
        $errors[] = "مفيش بيانات دخلت" ;
    }

    // التحقق من طول الاسم
    if ( longer_than_255 ( $fullname ) ) {
        $errors[] = "الاسم اطول من 255 حرف" ;
    }

    // التحقق من طول المادة
    if ( longer_than_50 ( $subject ) ) {
        $errors[] = "اسم المادة اطول من 55 حرف" ;
    }

    if ( is_invalid_id ( $school_id ) ) {
        $errors[] = "كود المدرسم مش صح" ;
    }

    if ( nation_id_invalid ( $nation_id ) ) {
        $errors[] = "الرقم القومي مش صحيح" ;
    }

    if ( empty ( $errors ) && is_nation_id_globally_used ( $pdo , $nation_id ) ) {
        $errors[] = "هذا الرقم القومي مستخدم بالفعل كولي أمر، أو كطالب، أو كمعلم." ;
    }

    if ( $errors ) {
        $_SESSION[ 'err' ] = $errors ;
        header ( "Location: ../index.php?err=yes" ) ;
        die () ;
    } else {
        $query = "INSERT INTO teachers (fullname, school_id, subject, nation_id) 
                  VALUES (:fullname, :school_id, :subject, :nation_id);" ;

        $stmt = $pdo -> prepare ( $query ) ;

        $stmt -> bindParam ( ":fullname" , $fullname ) ;
        $stmt -> bindParam ( ":school_id" , $school_id ) ;
        $stmt -> bindParam ( ":subject" , $subject ) ;
        $stmt -> bindParam ( ":nation_id" , $nation_id ) ;

        $stmt -> execute () ;

        $pdo = null ;
        $stmt = null ;

        header ( "Location: ../index.php" ) ;
        die () ;
    }
} else {
    header ( "Location: /index.php" ) ;
    die () ;
}
