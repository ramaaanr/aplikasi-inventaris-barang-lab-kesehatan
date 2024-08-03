<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Controller;

use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\BarangRusak;
use Fahmi\InventoryBarangLaboratoriumKesehatan\Model\Barang;

class DataBarangRusak
{
    private $barangRusakModel;
    private $barangModel;

    public function __construct()
    {
        $this->barangRusakModel = new BarangRusak();
        $this->barangModel = new Barang(); // Assuming you have a Barang model
    }

    // Menampilkan halaman index barang rusak
    public function index()
    {

        $barangList = $this->barangModel->getAll();
        include __DIR__ . '/../View/DataBarangRusak/index.php';
    }

    public function getAll()
    {
        header('Content-Type: application/json');
        $data = $this->barangRusakModel->getAll();
        echo json_encode($data);
    }

    // Menambahkan barang rusak baru
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the admin ID from the session
            $id_admin = $_SESSION['id_admin'];

            try {
                // Upload the file and get the filename
                $foto = $this->uploadFile($_FILES['foto_barang']);

                // Prepare the data for insertion
                $data = [
                    'id_barang' => $_POST['id_barang'],
                    'jumlah_rusak' => $_POST['jumlah_rusak'],
                    'id_admin' => $id_admin,
                    'keterangan' => $_POST['keterangan'],
                    'foto' => $foto
                ];

                // Add the damaged goods record
                $result = $this->barangRusakModel->add($data);

                // Return success response
                header('Content-Type: application/json');
                echo json_encode(['success' => $result]);
            } catch (\Exception $e) {
                // Return error response with the exception message
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        } else {
            // If not a POST request, display the add form
            $barang = $this->barangModel->getAll(); // Get all barang for dropdown
            include __DIR__ . '/../View/DataBarangRusak/tambah.php';
        }
    }


    // Fungsi untuk mengupload file dan mengembalikan nama file
    private function uploadFile($file)
    {
        // Define allowed file types and maximum file size (2MB)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        // Check if the file was uploaded without errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception("Upload file bermasalah.");
        }

        // Validate file size
        if ($file['size'] > $maxFileSize) {
            throw new \Exception("Ukuran maksimal file 2MB.");
        }

        // Validate file type
        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            throw new \Exception("Format tidak sesuai. Hanya JPEG, PNG, dan GIF.");
        }

        // Define the target directory and file path
        $targetDir = __DIR__ . "/../../uploads/";
        $targetFile = $targetDir . basename($file["name"]);

        // Create uploads directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return basename($file["name"]); // Return just the file name for storage
        } else {
            throw new \Exception("Failed to upload file.");
        }
    }
}
