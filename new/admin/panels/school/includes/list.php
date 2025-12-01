<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/School.php';

use oop\SessionManager;
use oop\Admin\School;

$session = new SessionManager();
$session->start_session();

$school = new School();

if ($_SESSION['role_name'] !== 'sudo' || !isset($_GET['page'])) {
    header("Location: /index.php");
    die();
}

$perPage = 5;
$page = (int)$_GET['page'];
$state_id = $_GET['state_id'] ?? 0;
$startAt = ($page - 1) * $perPage;

$keyword = $_GET['keyword'] ?? '';
$schools = $school->get_schools($startAt, $keyword, $state_id);

$total = $school->get_total($keyword);

$response = [
    'ok' => 1,
    'total' => $total,
    'schools' => $schools,
];

echo json_encode($response);
exit();