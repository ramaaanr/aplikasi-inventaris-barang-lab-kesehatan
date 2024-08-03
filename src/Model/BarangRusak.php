<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Model;

use PDO;
use PDOException;

class BarangRusak
{
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

    // Function to get all damaged goods data
    public function getAll()
    {
        $query = "SELECT br.id, b.nama_barang, br.jumlah_rusak, br.created_at, br.keterangan, br.foto, a.username 
                  FROM barang_rusak br 
                  INNER JOIN barang b ON br.id_barang = b.id 
                  INNER JOIN admin a ON br.id_admin = a.id";  // Join with the admin table to get the username
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to add a new damaged good
    public function add($data)
    {
        $query = "INSERT INTO barang_rusak (id_barang, jumlah_rusak, id_admin, keterangan, foto) 
                  VALUES (:id_barang, :jumlah_rusak, :id_admin, :keterangan, :foto)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_barang', $data['id_barang']);
        $stmt->bindParam(':jumlah_rusak', $data['jumlah_rusak']);
        $stmt->bindParam(':id_admin', $data['id_admin']);
        $stmt->bindParam(':keterangan', $data['keterangan']);
        $stmt->bindParam(':foto', $data['foto']);
        return $stmt->execute();
    }

    // Function to get a single damaged good's data by ID
    public function getById($id)
    {
        $query = "SELECT br.id, b.nama_barang, br.jumlah_rusak, br.created_at, br.keterangan, br.foto, a.username 
                  FROM barang_rusak br 
                  INNER JOIN barang b ON br.id_barang = b.id 
                  INNER JOIN admin a ON br.id_admin = a.id 
                  WHERE br.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
