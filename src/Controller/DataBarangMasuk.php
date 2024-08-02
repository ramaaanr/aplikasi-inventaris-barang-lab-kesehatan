<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\BarangMasuk;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Barang;

class DataBarangMasuk {
    private $barangMasukModel;
    private $barangModel;

    public function __construct() {
        $this->barangMasukModel = new BarangMasuk();
        $this->barangModel = new Barang();
    }

    // Display all pending stock requests
    public function index() {
        $requests = $this->barangMasukModel->getAll();
        $barangList = $this->barangModel->getAll();
        include __DIR__ . '/../View/DataBarangMasuk/index.php';
    }

    // Handle new stock request submission
    public function add($data) {
        $result = $this->barangMasukModel->add($data);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }

    // Update the status of a stock request
    public function updateStatus($id, $status) {
        if ($status === null) {
            echo json_encode(['success' => false, 'message' => 'Invalid status provided.']);
            return;
        }

        $result = $this->barangMasukModel->updateStatus($id, $status);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }

    // Get all BarangMasuk records
    public function getAll() {
        $data = $this->barangMasukModel->getAll();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}
