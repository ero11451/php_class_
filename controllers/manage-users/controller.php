<?php
 
function  ManageUserController(){
    handleRequestMethod('post', function($request){
      $userModel = new UserModel();
      $userModel->create($request['body']);
    });

    handleRequestMethod('get', function($request){
        $userModel = new UserModel();
        $users = $userModel->getList();
        return AdminLayout(__DIR__ . '/view.php', ['users' => $users]);        
    });
}