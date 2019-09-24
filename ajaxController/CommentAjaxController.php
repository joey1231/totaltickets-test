<?php
include_once 'BaseController.php';
include_once __DIR__ . '/../Models/Comment.php';

class CommentAjaxController extends BaseController
{

    public function store($request)
    {
        $errors = $this->validator($request, ['post_id' => ['required'], 'body' => ['required']]);

        if (count($errors) > 0) {
            return $this->errorResponse($errors);
        }

        $comment = new Comment();
        $comment->post_id = $request['post_id'] ?? '';
        $comment->body = $request['body'] ?? '';
        $comment->user_id = $_SESSION['user']['id'];
        $comment->created_at = date('Y-m-d H:i:s');
        $comment->save();

        return $this->successResponse($comment);
    }

    public function validator($request, $rules)
    {

        $errors = [];

        foreach ($rules as $key => $rule) {
            $error = [];
            foreach ($rule as $c => $v) {
                if ($v == 'required') {
                    if (!isset($request[$key]) || empty($request[$key])) {
                        $error[] = $key . ' is required';
                    }

                }

                if ($v == 'email') {
                    if (filter_var($request[$key], FILTER_VALIDATE_EMAIL) === false) {
                        $error[] = $key . ' is invalid format';
                    }

                }
            }

            if (count($error) > 0) {
                $errors[$key] = $error;
            }

        }

        return $errors;
    }
}
