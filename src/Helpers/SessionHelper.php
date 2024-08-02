<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers;

class SessionHelper
{
    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isAdminLoggedIn()
    {
        return isset($_SESSION['id_admin']);
    }
}
