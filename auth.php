<?php

include 'ajaxController/RegisterAjaxController.php';
$method = $_REQUEST['method'];
session_start();

$registerController = new RegisterAjaxController;

switch ($method) {
    case 'post':
        echo $registerController->register($_REQUEST);
        break;
    case 'login':
        echo $registerController->login($_REQUEST);
        break;
    default:
        # code...
        break;
}
