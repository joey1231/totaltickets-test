<?php
include_once 'config/config.php';
session_start();
ob_start();
$user = $_SESSION['user'] ?? null;
$title = 'Profile';
$data = [
    'user' => $user,
];

include 'view/user/profile.php';

$content = ob_get_contents();
ob_end_clean();

include 'view/layout.php';
