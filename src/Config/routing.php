<?php

use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\Auth;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\DataBarang;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\DataBarangMasuk;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\DataBarangKeluar;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\DataBarangHabis;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Controller\DataBarangRusak;

return function () {
    // Instantiate controllers
    $authController = new Auth();
    $barangController = new DataBarang();
    $barangMasukController = new DataBarangMasuk();
    $barangKeluarController = new DataBarangKeluar();
    $barangHabisController = new DataBarangHabis();
    $barangRusakController = new DataBarangRusak();

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
            $authController->dashboard();
            break;

        case 'barang':
            switch (strtolower($method)) {
                case 'show':
                    $barangController->index();
                    break;
                case 'cetak':
                    $barangController->exportBarangToPdf();
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

                case 'getbaranghabis':
                    $barangController->getAllEmptyStock();
                    break;

                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangController->addBarang($_POST);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                default:
                    // Handle unknown methods
                    header('HTTP/1.0 404 Not Found');
                    echo '404 Not Found';
                    break;
            }
            break;

        case 'barangmasuk':
            switch (strtolower($method)) {
                case 'show':
                    $barangMasukController->index();
                    break;

                case 'cetak':
                    $barangMasukController->export();
                    break;
                case 'getall':
                    $barangMasukController->getAll();
                    break;

                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangMasukController->add($_POST);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                case 'updatestatus':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $status = $_POST['status'] ?? null;  // Get status from POST data
                        $barangMasukController->updateStatus($id, $status);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                case 'approve':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangMasukController->approve($id);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;
                case 'reject':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangMasukController->reject($id);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                default:
                    // Handle unknown methods
                    header('HTTP/1.0 404 Not Found');
                    echo '404 Not Found';
                    break;
            }
            break;

        case 'barangkeluar':
            switch (strtolower($method)) {
                case 'show':
                    $barangKeluarController->index();
                    break;

                case 'cetak':
                    $barangKeluarController->export();
                    break;
                case 'getall':
                    $barangKeluarController->getAll();
                    break;

                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangKeluarController->add($_POST);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                case 'updatestatus':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $status = $_POST['status'] ?? null;  // Get status from POST data
                        $barangKeluarController->updateStatus($id, $status);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;
                case 'approve':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangKeluarController->approve($id);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;
                case 'reject':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barangKeluarController->reject($id);
                    } else {
                        echo 'Invalid request method';
                    }
                    break;

                default:
                    // Handle unknown methods
                    header('HTTP/1.0 404 Not Found');
                    echo '404 Not Found';
                    break;
            }
            break;

        case 'baranghabis':
            switch (strtolower($method)) {
                case 'show':
                    $barangHabisController->index();
                    break;

                case 'cetak':
                    $barangController->exportDataHabis();
                    break;
                default:
                    // Handle unknown methods
                    header('HTTP/1.0 404 Not Found');
                    echo '404 Not Found';
                    break;
            }
            break;

        case 'barangrusak': // Add new routing for barang rusak
            switch (strtolower($method)) {
                case 'show':
                    $barangRusakController->index();
                    break;

                case 'cetak':
                    $barangRusakController->export();
                    break;
                case 'add':
                    $barangRusakController->add();
                    break;

                case 'getall':
                    $barangRusakController->getAll();
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