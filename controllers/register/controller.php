<?php
function    RegisterController()
{

    handleRequestMethod('post', function ($request) {
        $userModel = new UserModel();

        $rules = [
            'password'  => ['required' => true, 'min' => 3, 'max' => 20],
            'name'  => ['required' => true, 'min' => 3, 'max' => 20],
            'email' => ['required' => true, 'email' => true],
        ];

        $errors = validateProperties($request['body'], $rules);

        if (empty($errors)) {

            $userFound = $userModel->getUserByEmail($request['body']['email']);

            if (empty($userFound)) {

                $user = $request['body'];
                $user['password'] = password_hash($request['body']['password'], PASSWORD_DEFAULT);
                $userModel->create($user);

                $_SESSION['user'] = $user;
                $_SESSION['notification'] = [
                    'success' => true,
                    'message' => 'User logged in successfully',
                ];
                header('/products');
                exit;
            }

            MainAppLayout(
                __DIR__ . '/view.php',
                ['data' => [
                    ['Invalid email or password'],
                    ['Please try again']
                ]]
            );
        } else {
            MainAppLayout(
                __DIR__ . '/view.php',
                ['data' => $errors]
            );
        }
    });

    handleRequestMethod('get', function () {
        return MainAppLayout(__DIR__ . '/view.php',);
    });
}
