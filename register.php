<?php
include_once 'config/config.php';
session_start();
ob_start();
$user = null;
$title = 'Register';

include 'view/auth/register.php';

$content = ob_get_contents();
ob_end_clean();

include 'view/layout.php';
