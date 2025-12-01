<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";

function get_schools($pdo) {
    $query = "SELECT * FROM schools;";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = NULL;
    $stmt = NULL;

    return $results;
}

function print_schools($results) {
    if (empty($results)) {
        echo '<tr>لا يوجد مدارس</tr>';
    } else {
        foreach ($results as $row) {
            echo '<tr><td>' . $row['id'] .'</td><td>' . $row['school_name'] .'</td></tr>';
        }
    }
}

print_schools(get_schools($pdo));
