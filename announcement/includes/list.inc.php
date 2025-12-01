<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.php');
    die();
}

$json_data = file_get_contents('php://input');
$request = json_decode($json_data, true);

require_once $_SERVER['DOCUMENT_ROOT'] . "/announcement/PostsHandler/Posts.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/SessionManager.php";

use PostsHandler\Posts;
use oop\SessionManager;

$session = new SessionManager();
$session->start_session();

$school_id = $_SESSION['school_id'];
$post = new Posts($school_id);

$perPage = 10;
$page = $request['page'];
$startAt = ($page - 1) * $perPage;

$keyword = $request['keyword'] ?? '';

$posts = $post->get_posts($startAt, $keyword);

$response = [
    "ok" => 1,
    "posts" => $posts
];

echo json_encode($response);

exit();