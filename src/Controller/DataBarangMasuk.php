<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\BarangMasuk;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Barang;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers\SessionHelper;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers\PrintDataHelper;


class DataBarangMasuk
{
    private $barangMasukModel;
    private $barangModel;

    public function __construct()
    {
        $this->barangMasukModel = new BarangMasuk();
        $this->barangModel = new Barang();
        SessionHelper::startSession();
    }

    // Display all pending stock requests
    public function index()
    {
        // Check if admin is already logged in
        if (!SessionHelper::isAdminLoggedIn()) {
            // If logged in, redirect to dashboard
            header('Location: /auth/login');
            exit();
        }
        $username = SessionHelper::getUsername();
        $isKepalaLab = SessionHelper::isKepalaLab();
        $requests = $this->barangMasukModel->getAll();
        $barangList = $this->barangModel->getAll();
        include __DIR__ . '/../View/DataBarangMasuk/index.php';
    }

    // Handle new stock request submission
    public function add($data)
    {
        $result = $this->barangMasukModel->add($data);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }

    // Update the status of a stock request
    public function updateStatus($id, $status)
    {
        if ($status === null) {
            echo json_encode(['success' => false, 'message' => 'Invalid status provided.']);
            return;
        }

        $result = $this->barangMasukModel->updateStatus($id, $status);
        header('Content-Type: application/json');
        echo json_encode($result ? ['success' => true] : ['success' => false]);
    }

    // Get all BarangMasuk records
    public function getAll()
    {
        $data = $this->barangMasukModel->getAll();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function approve($id)
    {
        // Get the request details
        $barangMasuk = $this->barangMasukModel->getById($id);

        header('Content-Type: application/json');
        if (!$barangMasuk) {
            // If the request is not found
            echo json_encode(['success' => false, 'message' => 'Request not found.']);
            return;
        }

        // Update the stock in the Barang table
        $updateStockResult = $this->barangModel->increaseStock($barangMasuk['id_barang'], $barangMasuk['jumlah']);

        if (!$updateStockResult) {
            // If the stock update fails
            echo json_encode(['success' => false, 'message' => 'Failed to update stock.']);
            return;
        }

        // Update the status of the BarangMasuk request to 'approved'
        $updateStatusResult = $this->barangMasukModel->updateStatus($id, 'disetujui');

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

        // Update the status of the BarangMasuk request to 'approved'
        $updateStatusResult = $this->barangMasukModel->updateStatus($id, 'ditolak');

        if ($updateStatusResult) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update request status.']);
        }
    }

    public function export()
    {
        $data = $this->barangMasukModel->getAll();
        PrintDataHelper::exportDataBarangMasuk($data);
    }
}