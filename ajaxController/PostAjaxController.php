<?php
include 'BaseController.php';
include __DIR__ . '/../Models/Post.php';

class PostAjaxController extends BaseController
{

    public function store($request)
    {
        $errors = $this->validator($request, ['title' => ['required'], 'body' => ['required']]);

        if (count($errors) > 0) {
            return $this->errorResponse($errors);
        }

        $post = new Post();
        $post->title = $request['title'] ?? '';
        $post->body = $request['body'] ?? '';
        $post->user_id = $_SESSION['user']['id'];
        $post->created_at = date('Y-m-d H:i:s');
        $post->save();

        return $this->successResponse($post);
    }
    public function update($request)
    {
        $errors = $this->validator($request, ['title' => ['required'], 'body' => ['required']]);

        if (count($errors) > 0) {
            return $this->errorResponse($errors);
        }

        $post = (new Post())->whereId($request['id'])->first();
        $post->title = $request['title'] ?? '';
        $post->body = $request['body'] ?? '';
        $post->user_id = $_SESSION['user']['id'];
        $post->save();

        return $this->successResponse($post);
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
