<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Model;

use PDO;
use PDOException;

class Admin
{
    private $db;

    public function __construct()
    {
        // Load database configuration
        $config = require __DIR__ . '/../Config/database.php';

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8";
            $this->db = new PDO($dsn, $config['username'], $config['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getAdminByUsername($username)
    {
        $query = "SELECT * FROM admins WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
