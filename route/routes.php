<?php

$routes = [
    '/'        => 'ProductController',    // This should be a function
    '/products' => 'ProductController',
    '/login'=> 'LoginController',
    '/register'=> 'RegisterController',
    '/logout'    => 'LogoutController',
    '/cart'=> 'CartController',
    '/home'    => 'HomeController',       // Optional: if you have a home page
    '/product-details' => 'ProductDetailsController',
    '/manage-products' => 'ManageProductsController',
    '/manage-users' => 'ManageUsersController',


];


$protectedRoutes = [
    '/home',      // example: only logged-in users can access this
    // '/products', // add more if needed
];

$adminRoutes = [
    '/manage-products',      // example: only logged-in users can access this
    '/dashboard', // add more if needed
    '/manage-users',      // example: only logged-in users can access this
];
