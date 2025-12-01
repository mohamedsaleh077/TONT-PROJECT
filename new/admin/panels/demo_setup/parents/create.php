<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/input_validation.inc.php" ;

    $fullname = $_POST[ "full_name" ] ;
    $nation_id = $_POST[ "nation_id" ] ;

    $errors = [] ;
    if ( all_empty ( [ $fullname , $nation_id ] ) ) {
        $errors[] = "مفيش بيانات دخلت" ;
    }

    if ( longer_than_255 ( $fullname ) ) {
        $errors[] = "الاسم اطول من 255 حرف" ;
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
        $query = "INSERT INTO parents (fullname, nation_id) VALUES 
    (:fullname, :nation_id);" ;

        $stmt = $pdo -> prepare ( $query ) ;

        $stmt -> bindParam ( ":fullname" , $fullname ) ;
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