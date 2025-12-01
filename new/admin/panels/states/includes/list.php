<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/DataValidation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/new/oop/Admin/State.php';

use oop\DataValidation;
use oop\Admin\State;
use oop\SessionManager;

$session = new SessionManager();
$session->start_session();

$state = new State();

if ($_SESSION['role_name'] !== 'sudo' || !isset($_GET['page'])) {
    header("Location: /index.php");
    die();
}

$perPage = 5;
$page = (int)$_GET['page'];
$startAt = ($page - 1) * $perPage;

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$_states = $state->get_state($startAt, $keyword);

$total = $state->get_total($keyword);

$response = [
    'ok' => 1,
    'total' => $total,
    'states' => $_states,
];

echo json_encode($response);
exit();