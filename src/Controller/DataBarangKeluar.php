<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\BarangKeluar;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Barang;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers\SessionHelper;

class DataBarangKeluar {
    private $barangKeluarModel;
    private $barangModel;

    public function __construct() {
        $this->barangKeluarModel = new BarangKeluar();
        $this->barangModel = new Barang();
        SessionHelper::startSession();
    }

    // Display all pending stock requests
    public function index() {
        // Check if admin is already logged in
        if (!SessionHelper::isAdminLoggedIn()) {
            // If logged in, redirect to dashboard
            header('Location: /auth/login');
            exit();
        }
        $username = SessionHelper::getUsername();
        $isKepalaLab = SessionHelper::isKepalaLab();
        $requests = $this->barangKeluarModel->getAll();
        $barangList = $this->barangModel->getAll();
        include __DIR__ . '/../View/DataBarangKeluar/index.php';
    }

    // Handle new stock request submission
    public function add($data) {
        // Get the available stock for the selected item
        $barang = $this->barangModel->getById($data['id_barang']);

        if ($barang['stok'] < $data['jumlah']) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Jumlah pengajuan melebihi stok yang tersedia!'
            ]);
            return;
        }

        // Proceed to add the request if stock is sufficient
        $result = $this->barangKeluarModel->add($data);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }

    // Update the status of a stock request
    public function updateStatus($id, $status) {
        if ($status === null) {
            echo json_encode(['success' => false, 'message' => 'Invalid status provided.']);
            return;
        }

        $result = $this->barangKeluarModel->updateStatus($id, $status);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }

    // Get all BarangKeluar records
    public function getAll() {
        $data = $this->barangKeluarModel->getAll();

        // Format the date using PHP's date_format
        foreach ($data as &$item) {
            $item['created_at'] = date_format(date_create($item['created_at']), 'd F Y H:i');
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function approve($id)
    {
        // Get the request details
        $barangKeluar = $this->barangKeluarModel->getById($id);

        header('Content-Type: application/json');
        if (!$barangKeluar) {
            // If the request is not found
            echo json_encode(['success' => false, 'message' => 'Request not found.']);
            return;
        }

        $barang = $this->barangModel->getById($barangKeluar['id_barang']);

        if ($barang['stok'] < $barangKeluar['jumlah']) {
            echo json_encode([
                'success' => false,
                'message' => 'Jumlah pengajuan melebihi stok yang tersedia!'
            ]);
            return;
        }

        $updateStockResult = $this->barangModel->decreaseStock($barangKeluar['id_barang'], $barangKeluar['jumlah']);

        if (!$updateStockResult) {
            // If the stock update fails
            echo json_encode(['success' => false, 'message' => 'Failed to update stock.']);
            return;
        }

        // Update the status of the BarangKeluar request to 'approved'
        $updateStatusResult = $this->barangKeluarModel->updateStatus($id, 'disetujui');

        if ($updateStatusResult) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update request status.']);
        }
    }
    public function reject($id)
    {
        // Get the request details

        header('Content-Type: application/json');

        // Update the status of the BarangKeluar request to 'approved'
        $updateStatusResult = $this->barangKeluarModel->updateStatus($id, 'ditolak');

        if ($updateStatusResult) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update request status.']);
        }
    }
}
