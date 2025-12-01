<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $email = $_POST[ "email" ] ;
    $pwd = $_POST[ "pwd" ];

    try {
        require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;
        require_once "create.inc.model.php" ;
        require_once "get_account.inc.model.php" ;
        require_once "create.inc.contlr.php" ;
        require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/config_session.inc.php" ;

        $errors = [] ;

        // Error Handlers
        if ( isInputEmpty ( $email , $pwd ) ) {
            $errors[ "EmptyInput" ] = "Fill in all fields!" ;
        }
        if ( is_email_invalid ( $email ) ) {
            $errors[ "invalid_email" ] = "your email is invalid." ;
        }
        if ( is_eamil_taken ( $pdo , $email ) ) {
            $errors[ "email_taken" ] = "this email is used." ;
        }
        if ( is_email_len_invalid ( $email ) ) {
            $errors[ "email_length" ] = "your email length is longer than usual?" ;
        }
        if ( is_password_length_invalid ( $pwd ) ) {
            $errors[ "pwd_length" ] = "either your password is less than 6 or longer than 250." ;
        }

        if ( $errors ) {
            $_SESSION[ "err" ] = $errors ;
            header ( "Location: ../create.php" ) ;
            die () ;
        } else {
            $results = get_user_details_by_nation_id ( $pdo , $_SESSION['nation_id'] , $_SESSION['role'] ) ;

            // 2. تهيئة المتغيرات للإدراج في جدول users
            $ref_id = $results[ 'ref_id' ] ;
            $fullname = $results[ 'fullname' ] ;
            $user_role = $_SESSION['role'] ;
            $nation_id = $results[ 'nation_id' ] ?? $results[ 'student_nation_id' ];
            $school_id = $results[ 'school_id' ] ; // يمكن أن يكون NULL لولي الأمر
            $subject = $results[ 'subject' ] ;     // يمكن أن يكون NULL للطالب/ولي الأمر
            $grade = $results[ 'grade' ] ; 
            // 3. إنشاء حساب المستخدم في جدول users
            $success = create_user_account (
                    $pdo ,
                    $ref_id ,
                    $fullname ,
                    $nation_id ,
                    $user_role ,
                    $email ,
                    $pwd ,
                    $school_id,
                    $subject,
                    $grade
            ) ;
            session_unset () ;
            session_destroy () ;
            header ( "Location: /login/index.php?info=done" ) ;
            exit () ;
        }
    } catch ( PDOException $e ) {
        die ( "Query Failed: " . $e -> getMessage () ) ;
    }
} else {
    header ( "Location: /index.php" ) ;
    die () ;
}
