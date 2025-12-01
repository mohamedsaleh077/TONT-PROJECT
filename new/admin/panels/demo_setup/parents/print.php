<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";

function get_parents($pdo) {
    $query = "SELECT * FROM parents ORDER BY id DESC;";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = NULL;
    $stmt = NULL;

    return $results;
}

function print_parents($results) {
    if (empty($results)) {
        echo '<tr>لا يوجد أولياء أمور</tr>';
    } else {
        foreach ($results as $row) {
            echo '<tr><td>' . $row['id'] .'</td><td>' . $row['fullname'] .'</td><td>' . $row['nation_id'] .'</td></tr>';
        }
    }
}

print_parents(get_parents($pdo));
