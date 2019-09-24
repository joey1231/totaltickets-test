<?php
include 'BaseController.php';
include __DIR__ . '/../Models/User.php';

class UserAjaxController extends BaseController
{

    public function update($request)
    {
        $errors = $this->validator($request, ['email' => ['email', 'required']]);

        if (count($errors) > 0) {
            return $this->errorResponse($errors);
        }

        $user = (new User())->whereId($request['id'])->first();
        $user->name = $request['name'] ?? '';
        $user->email = $request['email'] ?? '';

        if (isset($request['password']) && !is_null($request['password'])) {
            $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
        }

        $user->save();
        $_SESSION['user'] = ['name' => $user->name, 'email' => $user->email, 'id' => $user->id];

        return $this->successResponse($user);
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
