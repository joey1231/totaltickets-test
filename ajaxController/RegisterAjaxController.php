<?php
include 'BaseController.php';
include __DIR__ . '/../Models/User.php';

class RegisterAjaxController extends BaseController
{

    public function register($request)
    {
        $errors = $this->validator($request);
        if (count($errors) > 0) {
            return $this->errorResponse($errors);
        }
        $user = new User();
        $user->name = $request['name'] ?? '';
        $user->email = $request['email'];
        $user->password = hash('sha256', $request['password']);
        $user->save();

        $_SESSION['user'] = ['name' => $user->name, 'email' => $user->email, 'id' => $user->id];

        return $this->successResponse($user);

    }

    public function login($request)
    {
        $errors = $this->validator($request);
        if (count($errors) > 0) {
            return $this->errorResponse($errors);
        }

        $user = (new User())->whereEmailPassword($request['email'], hash('sha256', $request['password']))->first();

        if (is_null($user)) {
            return $this->errorResponse(['error' => ['invalid credentials']]);
        }
        $_SESSION['user'] = ['name' => $user->name, 'email' => $user->email, 'id' => $user->id];
        return $this->successResponse($user);

    }

    public function validator($request)
    {
        $rules = [
            'email' => ['email', 'required'],
            'password' => ['required'],
        ];

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
