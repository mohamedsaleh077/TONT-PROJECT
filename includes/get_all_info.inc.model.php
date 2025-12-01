<?php
declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";

function fetch_all(object $pdo, int $user_id) {
    $role = $_SESSION['user_role'];

    switch ($role) {
        case 'student':
            $query = "SELECT 
                        s.fullname,
                        s.grade,
                        s.student_code,
                        s.pfp,
                        s.bio,
                        s.school_id,
                       school.school_name,
                       school.school_level
                      FROM students AS s
                      INNER JOIN schools AS school ON school.id = s.school_id
                      WHERE s.id = :user_id;";
            break;
        case 'teacher':
            $query = "SELECT 
                        t.fullname,
                        t.subject,
                        t.teacher_code,
                        t.pfp,
                        t.bio,
                        t.school_id,
                       school.school_name,
                       school.school_level
                      FROM teachers AS t
                      INNER JOIN schools AS school ON school.id = t.school_id
                      WHERE t.id = :user_id;";
            break;
        case 'parent':
            $query = "SELECT
                        p.fullname,
                        s.*
                        s.school_id,
                      FROM parents AS p
                      INNER JOIN students AS s ON s.parent_id = p.id
                      WHERE p.id = :user_id;";
            break;
        default:
            header("Location /index.php");
            die();
    }
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $resulte = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
    return $resulte;
}