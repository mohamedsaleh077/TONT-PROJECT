<?php

function fetch_students ($pdo, $school_id) {
    $query = "SELECT * from students WHERE school_id=:school_id;" ;
    $school_id = $_SESSION[ 'school_id' ] ;

    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ":school_id" , $school_id ) ;
    $stmt -> execute () ;

    $resulte = $stmt -> fetchAll () ;

    $pdo = null ;
    $stmt = null ;
    return $resulte ;
}

function student_info($pdo, $user_id){
    $query = "SELECT * from students WHERE id = :userid;" ;

    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ":userid" , $user_id ) ;
    $stmt -> execute () ;

    $resulte = $stmt -> fetch(PDO::FETCH_ASSOC) ;

    $pdo = null ;
    $stmt = null ;
    return $resulte ;
}

function print_student_list ($pdo, $school_id) {
    $student_list = fetch_students ($pdo, $school_id) ;

    echo '<tr><td>كود الطالب</td><td>الاسم</td><td>المرحلة</td></tr>';
    
    foreach ( $student_list as $value ) {
        $url = "teacher_editor.php?id=" . htmlspecialchars ( $value[ 'id' ] ) ;
        echo "<tr>" ;
        echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars ( $value[ 'id' ] ) . "</a></td>" ;
        echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars ( $value[ 'fullname' ] ) . "</a></td>" ;
        echo "<td><a href='" . $url . "' target='_blank'>" . htmlspecialchars ( $value[ 'grade' ] ) . "</a></td>" ;
        echo "</a></tr>" ;
    }
}

