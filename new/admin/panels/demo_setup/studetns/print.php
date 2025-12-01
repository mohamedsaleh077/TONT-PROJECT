<?php

ini_set ( 'display_errors' , 1 ) ;
ini_set ( 'display_startup_errors' , 1 ) ;
error_reporting ( E_ALL ) ;

require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/includes/db.inc.php" ;

$query = "
        SELECT
        s.id,
        schools.school_name,
        s.fullname,
        s.grade,
        s.student_nation_id,
        parents.fullname AS parent_name
    FROM students AS s
    JOIN schools ON s.school_id = schools.id
    JOIN parents ON s.parent_id = parents.id
    ORDER BY s.school_id;
    " ;

$stmt = $pdo -> prepare ( $query ) ;
$stmt -> execute () ;
$results = $stmt -> fetchAll ( PDO :: FETCH_ASSOC ) ;

if ( empty ( $results ) ) {
    echo '<tr>لا يوجد طلاب</tr>' ;
} else {
    foreach ( $results as $row ) {
        echo '<tr><td>' . htmlspecialchars ( $row[ 'id' ] ) .
        '</td><td>' . htmlspecialchars ( $row[ 'school_name' ] ) .
        '</td><td>' . htmlspecialchars ( $row[ 'fullname' ] ) .
        '</td><td>' . htmlspecialchars ( $row[ 'parent_name' ] ) .
        '</td><td>' . htmlspecialchars ( $row[ 'grade' ] ) .
        '</td><td>' . htmlspecialchars ( $row[ 'student_nation_id' ] ) .
        '</td></tr>' ;
    }
}

$stmt = NULL ;
