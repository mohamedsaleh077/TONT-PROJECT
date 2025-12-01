<?php

declare(strict_types = 1) ;

function getUser ( object $pdo , string $email ) {
    $query = "SELECT
	u.id,
    u.role,
    u.ref_id,
    COALESCE(s.fullname, t.fullname, pu.fullname, sh.school_name) AS name,
    s.grade AS student_grade,
    t.subject AS teacher_subject,
    sh.school_name AS school_name,
    COALESCE(s.school_id, t.school_id) AS school_id,
    u.email,
    u.2fa_secret,
    u.2fa_is_active,
    u.profile_picture,
    u.bio,
    u.pwd
FROM
    users AS u
LEFT JOIN
    students s ON u.ref_id = s.id AND u.role = 'student'
LEFT JOIN
    teachers t ON u.ref_id = t.id AND u.role = 'teacher'
LEFT JOIN
	parents pu ON u.ref_id = pu.id AND u.role = 'parent'
LEFT JOIN
	schools sh ON s.school_id = sh.id OR t.school_id = sh.id
WHERE
    u.email = :email;" ;

    $stmt = $pdo -> prepare ( $query ) ;
    $stmt -> bindParam ( ":email" , $email ) ;
    $stmt -> execute () ;

    $resulte = $stmt -> fetch ( PDO :: FETCH_ASSOC ) ;

    $pdo = null ;
    $stmt = null ;
    return $resulte ;
}
