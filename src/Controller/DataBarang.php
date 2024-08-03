<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Barang;

class DataBarang
{
    private $barangModel;

    public function __construct()
    {
        $this->barangModel = new Barang();
    }

    // Display the data
    public function index()
    {
        $data = $this->barangModel->getAll();
        include __DIR__ . '/../View/DataBarang/index.php';
    }

    // Handle item editing
    public function edit($id, $data)
    {
        $result = $this->barangModel->edit($id, $data);
        header('Content-Type: application/json');
        echo json_encode($result);
        if ($result) {
            // Redirect or display a success message
        } else {

            // Handle the error
            echo "Error updating the item.";
        }
    }

    // Handle item soft deletion
    public function delete($id)
    {
        if ($this->barangModel->softDelete($id)) {
            // Redirect or display a success message
            header('Location: /barang');
        } else {
            // Handle the error
            echo "Error deleting the item.";
        }
    }

    // Get all items in JSON format
    public function getAllJson()
    {
        header('Content-Type: application/json');
        $data = $this->barangModel->getAll();
        echo json_encode($data);
    }
    public function getAllEmptyStock()
    {
        header('Content-Type: application/json');
        $data = $this->barangModel->getAllEmptyStock();
        echo json_encode($data);
    }

    
    // Add a new Barang
    public function addBarang($data) {
        $result = $this->barangModel->add($data);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }
}
