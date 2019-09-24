<?php

$method = $_REQUEST['method'];
session_start();

switch ($method) {
    case 'update':
        include 'ajaxController/UserAjaxController.php';
        $userAjax = new UserAjaxController;
        echo $userAjax->update($_REQUEST);
        break;
    case 'savePost':
        include 'ajaxController/PostAjaxController.php';
        $postAjax = new PostAjaxController();
        echo $postAjax->store($_REQUEST);
        break;
    default:
        # code...
        break;
}
