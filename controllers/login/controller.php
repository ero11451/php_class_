<?php
function    LoginController()
{

    handleRequestMethod('post', function ($request) {
        $rules = [
            'password' => ['required' => true, 'min' => 3, 'max' => 20],
            'email'    => ['required' => true, 'email' => true],
        ];
    
        $errors = validateProperties($request['body'], $rules);
    
        if (!empty($errors)) {
            MainAppLayout(__DIR__ . '/view.php', ['data' => $errors]);
        } else {
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($request['body']['email']);
    
            if (!empty($user) && password_verify($request['body']['password'], $user[0]['password'])) {
                $_SESSION['user'] = $user[0];
                $_SESSION['notification'] = [
                    'success' => true,
                    'message' => 'User logged in successfully',
                ];
                header('Location: /products');
                exit;
            } else {
                MainAppLayout(__DIR__ . '/view.php', [
                    'data' => [
                        ['Invalid email or password'],
                        ['Please try again'],
                    ]
                ]);
            }
        }
    });
    


    // $service = new UserService();
    // $userList = $service->getUserList();
    MainAppLayout(__DIR__ . '/view.php');
    // apiResponse(true, 'User fetched successfully', $request['header']);

}


function LogoutController()
{
    session_destroy();
    header('Location: /login');
    exit;
}