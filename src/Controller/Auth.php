<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Admin;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers\SessionHelper;

class Auth
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
        SessionHelper::startSession();
    }

    public function login()
    {
        // Check if admin is already logged in
        if (SessionHelper::isAdminLoggedIn()) {
            // If logged in, redirect to dashboard
            header('Location: /dashboard/admin');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $admin = $this->adminModel->getAdminByUsername($username);

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['id_admin'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                // Redirect to dashboard
                header('Location: /dashboard/admin');
                exit();
            } else {
                $error = 'Invalid username or password';
                include __DIR__ . '/../View/admin/login.php';
            }
        } else {
            include __DIR__ . '/../View/admin/login.php';
        }
    }

    public function logout()
    {
        // Destroy the session
        session_destroy();

        // Redirect to login
        header('Location: /auth/login');
        exit();
    }

    public function dashboard()
    {
        if (!SessionHelper::isAdminLoggedIn()) {
            header('Location: /auth/login');
            exit();
        }

        include __DIR__ . '/../View/admin/dashboard.php';
    }
}
