<?php

use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\Auth;

return function () {
    // Instantiate the controller
    $authController = new Auth();

    // Get the requested URI and parse it
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/'); // Trim leading and trailing slashes

    // If the URI is empty, redirect to 'auth/login'
    if (empty($uri)) {
        header('Location: /auth/login');
        exit();
    }

    // Split the URI into parts
    $parts = explode('/', $uri);

    // Get the controller and method
    $controller = $parts[0] ?? 'auth';  // Default to 'auth' controller
    $method = $parts[1] ?? 'login';     // Default to 'login' method

    // Route to the appropriate controller and method
    switch (strtolower($controller)) {
        case 'auth':
            switch (strtolower($method)) {
                case 'login':
                    $authController->login();
                    break;

                case 'logout':
                    $authController->logout();
                    break;

                default:
                    // Handle unknown methods
                    header('HTTP/1.0 404 Not Found');
                    echo '404 Not Found';
                    break;
            }
            break;

        case 'dashboard':
            switch (strtolower($method)) {
                case 'admin':
                    $authController->dashboard();
                    break;

                default:
                    // Handle unknown methods
                    header('HTTP/1.0 404 Not Found');
                    echo '404 Not Found';
                    break;
            }
            break;

        default:
            // Handle unknown controllers
            header('HTTP/1.0 404 Not Found');
            echo '404 Not Found';
            break;
    }
};
