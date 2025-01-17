<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Model;

use PDO;
use PDOException;

class BarangMasuk {
    private $db;

    public function __construct() {
        $config = require __DIR__ . '/../Config/database.php';

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8";
            $this->db = new PDO($dsn, $config['username'], $config['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Get all requests
    public function getAll() {
        $stmt = $this->db->prepare("SELECT barang_masuk.*, barang.nama_barang, admin.username FROM barang_masuk 
                                    JOIN barang ON barang_masuk.id_barang = barang.id 
                                    JOIN admin ON barang_masuk.id_admin = admin.id ORDER BY created_at DESC
                                    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single request by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM barang_masuk WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new request
    public function add($data) {
        $stmt = $this->db->prepare("INSERT INTO barang_masuk (id_barang, jumlah, status, id_admin) VALUES (:id_barang, :jumlah, 'pending', :id_admin)");
        $stmt->bindParam(':id_barang', $data['id_barang'], PDO::PARAM_STR);
        $stmt->bindParam(':jumlah', $data['jumlah'], PDO::PARAM_STR);
        $stmt->bindParam(':id_admin', $_SESSION['id_admin'], PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Update the status of a request
    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE barang_masuk SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
