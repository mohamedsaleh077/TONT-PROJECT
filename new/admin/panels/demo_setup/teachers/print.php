<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";

$query = "
        SELECT
        t.id,
        schools.school_name,
        t.fullname,
        t.subject,
        t.nation_id
    FROM teachers AS t
    JOIN schools ON t.school_id = schools.id
    ORDER BY t.school_id;
    ";

$stmt = $pdo->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($results)) {
    echo '<tr>لا يوجد معلمين</tr>';
} else {
    foreach ($results as $row) {
        echo '<tr><td>' . htmlspecialchars($row['id']) .
        '</td><td>' . htmlspecialchars($row['fullname']) .
        '</td><td>' . htmlspecialchars($row['school_name']) .
        '</td><td>' . htmlspecialchars($row['subject']) .
        '</td><td>' . htmlspecialchars($row['nation_id']) .
        '</td></tr>';
    }
}
$stmt = NULL;
