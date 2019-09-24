<?php
include_once 'config/config.php';
include_once 'Models/Post.php';
include_once 'Models/User.php';
session_start();
ob_start();
$title = 'Home';
$user = $_SESSION['user'] ?? null;

$data = [
    'user' => $user,
];

$posts = (new Post())->get(true);
include 'view/home/post.php';

$content = ob_get_contents();
ob_end_clean();

include 'view/layout.php';
