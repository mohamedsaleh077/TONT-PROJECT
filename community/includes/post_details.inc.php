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

require_once $_SERVER['DOCUMENT_ROOT'] . "/community/CommunityOop/SinglePostHandler.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/SessionManager.php";

use CommunityOop\SinglePostHandler;
use oop\SessionManager;

$session = new SessionManager();
$session->start_session();

$post = new SinglePostHandler($post_id = $request['post_id']);

$posts = $post->get_post_details();
$comments = $post->get_comments();

$response = [
    "ok" => 1,
    "post" => $posts,
    "comments" => $comments
];

$_SESSION['user_auther_id'] = $response['post'][0]['user_id'];

echo json_encode($response);

exit();