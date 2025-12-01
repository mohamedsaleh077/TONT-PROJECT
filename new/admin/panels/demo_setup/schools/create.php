<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
    require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/input_validation.inc.php" ;

    $school_name = $_POST[ "school_name" ] ;

    $errors = [] ;
    if ( all_empty ( [ $school_name ] ) ) {
        $errors[] = "مفيش بيانات دخلت" ;
    }

    if ( longer_than_255 ( $school_name ) ) {
        $errors[] = "الاسم اطول من 255 حرف" ;
    }


    if ( $errors ) {
        $_SESSION[ 'err' ] = $errors ;
        header ( "Location: ../index.php?err=yes" ) ;
        die () ;
    } else {

        $query = "INSERT INTO schools (school_name) VALUES 
    (:school_name);" ;

        $stmt = $pdo -> prepare ( $query ) ;

        $stmt -> bindParam ( ":school_name" , $school_name ) ;
        $stmt -> execute () ;

        $pdo = null ;
        $stmt = null ;

        header ( "Location: ../index.php" ) ;
    }
} else {
    header ( "Location: /index.php" ) ;
    die () ;
}