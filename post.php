<?php
include_once 'config/config.php';
include_once 'Models/Post.php';
include_once 'Models/User.php';
session_start();
ob_start();
$user = $_SESSION['user'] ?? null;

$data = [
    'user' => $user,
];
$title = 'Post';
if (is_null($user)) {
    header("Location: index.php");
}
if (isset($_REQUEST['method'])) {
    switch ($_REQUEST['method']) {
        case 'create':
            include 'view/user/post/create.php';
            break;
        case 'view':
            $post = (new Post())->whereId($_REQUEST['id'])->first();

            include 'view/user/post/view.php';
            break;
        case 'addComment':
            include 'ajaxController/CommentAjaxController.php';
            $comment = new CommentAjaxController;
            $comment->store($_REQUEST);
            header("Location: " . $_REQUEST['redirect']);
            break;
        default:

            break;
    }
} else {
    $posts = (new Post())->whereUserId($user['id'])->get();

    include 'view/user/post/index.php';

}

$content = ob_get_contents();
ob_end_clean();

include 'view/layout.php';
