<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Model;

use PDO;
use PDOException;

class Barang {
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

    // Get all records
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllEmptyStock() {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE deleted_at IS NULL AND stok = 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Get a single record by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id = :id AND deleted_at IS NULL");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a record by ID
    public function edit($id, $data) {
        $nama_barang = $this->db->quote($data['nama_barang']);
        $satuan = $this->db->quote($data['satuan']);
        $harga = $this->db->quote($data['harga']); // Ensure harga is an integer
        $id = $this->db->quote($data['id']);; // Ensure id is an integer
    
        // Prepare the SQL query with data directly inserted
        $sql = "UPDATE barang SET 
                    nama_barang = $nama_barang, 
                    satuan = $satuan, 
                    harga = $harga 
                WHERE id = $id";
    
        // Execute the query
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Return the query for debugging purposes
        return $sql;
    }

    // Soft delete a record by ID
    public function softDelete($id) {
        $stmt = $this->db->prepare("UPDATE barang SET deleted_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

     // Add a new Barang
     public function add($data) {
        $query = "INSERT INTO barang (nama_barang, satuan, harga, stok) VALUES (:nama_barang, :satuan, :harga, :stok)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nama_barang', $data['nama_barang']);
        $stmt->bindParam(':satuan', $data['satuan']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':stok', $data['stok']);
        return $stmt->execute();
    }
}
