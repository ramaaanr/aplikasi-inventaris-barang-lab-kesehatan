<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Admin;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\KepalaLab;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers\SessionHelper;

class Auth
{
    private $adminModel;
    private $kepalaLabModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
        $this->kepalaLabModel = new KepalaLab();
        SessionHelper::startSession();
    }

    public function login()
    {
        // Check if admin is already logged in
        if (SessionHelper::isAdminLoggedIn()) {
            // If logged in, redirect to dashboard
            $username = SessionHelper::getUsername();
            header('Location: /dashboard/admin');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $admin = $this->adminModel->getAdminByUsername($username);
            $kepalaLab = $this->kepalaLabModel->getKepalaLabByUsername($username);

            if ($kepalaLab && password_verify($password, $kepalaLab['password'])) {
                $_SESSION['id_admin'] = 99;
                $_SESSION['admin_username'] = $kepalaLab['nama'];
                $_SESSION['role'] = 'kepala_lab';
                // Redirect to dashboard
                header('Location: /dashboard/admin');
                exit();
            } else if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['id_admin'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['nama'];
                $_SESSION['role'] = 'admin';


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

        $username = SessionHelper::getUsername();
        include __DIR__ . '/../View/admin/dashboard.php';
    }
}
