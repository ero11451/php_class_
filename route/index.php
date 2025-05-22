<?php

include __DIR__ . '/../controllers/home/controller.php';
include __DIR__ . '/../controllers/products/controller.php';
include __DIR__ . '/../controllers/login/controller.php';
include __DIR__ . '/../controllers/register/controller.php';
include __DIR__ . '/../controllers/cart/controller.php';
include __DIR__ . '/../controllers/product-details/controller.php';
include __DIR__ . '/../controllers/manage-products/controller.php';
include __DIR__ . '/../controllers/manage-users/controller.php';
include __DIR__ . '/middleware.php';

class Router {

    private $routes;

    public function __construct() {
        $this->routes = [
            '/'        => 'HomeController',    // This should be a function
            '/products' => 'ProductController',
            '/team'    => 'HomeController',
            '/home'    => 'HomeController',       // Optional: if you have a home page
        ];
    }

    private $protectedRoutes = [
        '/home',      // example: only logged-in users can access this
        '/dashboard', // add more if needed
    ];


    
    public function route($path) {
        if (array_key_exists($path, $this->routes)) {

            if (in_array($path, $this->protectedRoutes) && !isAuthenticated()) {
                http_response_code(401);
                echo 'Unauthorized. Please log in to access this page.';
                return;
            }

            $controllerFunction = $this->routes[$path];

            if (function_exists($controllerFunction)) {
                 $controllerFunction(); // Output the result of the controller function
                    die();
            } else {
                http_response_code(500);
                echo "Error: Controller function '$controllerFunction' not found.";
            }

        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }

}


 function Router($path) {

    include __DIR__ . '/routes.php';

    if (array_key_exists($path, $routes)) {

        // if (in_array($path, $protectedRoutes) && !isAuthenticated()) {
        //     http_response_code(401);
        //     echo 'Unauthorized. Please log in to access this page.';
        //     return;
        // }

        if (in_array($path, $adminRoutes) && !isAdmin()) {
            http_response_code(401);
            echo 'Unauthorized. Please log in to access this page.';
            return;
        }
        
        $controllerFunction = $routes[$path];

        if (function_exists($controllerFunction)) {
             $controllerFunction(); // Output the result of the controller function
             die();
        } else {
            http_response_code(500);
            echo "Error: Controller function '$controllerFunction' not found.";
        }

    } else {
        http_response_code(404);
        echo '404 Not Found';
    }
}
