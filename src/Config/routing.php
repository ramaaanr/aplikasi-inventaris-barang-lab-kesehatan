<?php

use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\Auth;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\DataBarang;

return function () {
    // Instantiate controllers
    $authController = new Auth();
    $barangController = new DataBarang();

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
    $id = $parts[2] ?? null;            // Get the ID if it's available


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

        case 'databarang':
            switch (strtolower($method)) {
                case 'show':
                    $barangController->index();
                    break;
                case 'login':
                    $barangController->index();
                    break;

                case 'edit':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangController->edit($id, $_POST);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                case 'delete':
                    $barangController->delete($id);
                    break;

                case 'getall':
                    $barangController->getAllJson();
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
