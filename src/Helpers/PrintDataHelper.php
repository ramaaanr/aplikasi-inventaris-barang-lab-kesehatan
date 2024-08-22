<?php

namespace Fahmi\InventoryBarangLaboratoriumKesehatan\Helpers;

use TCPDF;

class PrintDataHelper
{
  public static function exportDataBarang($data)
  {
    $title = 'Data Barang';
    setlocale(
      LC_ALL,
      'id_ID.UTF8',
      'id_ID.UTF-8',
      'id_ID.8859-1',
      'id_ID',
      'IND.UTF8',
      'IND.UTF-8',
      'IND.8859-1',
      'IND',
      'Indonesian.UTF8',
      'Indonesian.UTF-8',
      'Indonesian.8859-1',
      'Indonesian',
      'Indonesia',
      'id',
      'ID',

      // Add english as default (if all Indonesian not available)
      'en_US.UTF8',
      'en_US.UTF-8',
      'en_US.8859-1',
      'en_US',
      'American',
      'ENG',
      'English',
    );

    // Create new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($title);
    $pdf->SetSubject('PDF Export');

    // Set footer fonts
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT); // Adjust top margin for header
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE,  PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Add header images and text
    $image1 = 'public/logo-1.png'; // Adjust path if necessary
    $image2 = 'public/logo-2.png'; // Adjust path if necessary

    // Adjust image size and position
    $pdf->Image($image1, 15, 15, 23); // left logo
    $pdf->Image($image2, 162, 20, 33); // right logo

    // Add header text
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'PEMERINTAH KABUPATEN BANJAR', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 7, 'DINAS KESEHATAN', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'UPTD. LABORATORIUM KESEHATAN DAERAH', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(0, 5, 'Jalan Pramuka Komplek Pangeran Antasari (Belakang POLRES Banjar) Martapura 70611', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Telp. (0511) 4720190 Email : labkesda.banjar@gmail.com', 0, 1, 'C');

    // Add a thick line below the header text (kop surat)
    $pdf->SetLineWidth(0.25); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 51, 195, 51); // Draw the line from left margin to right margin
    $pdf->SetLineWidth(0.5); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 52, 195, 52); // Draw the line from left margin to right margin

    // Set font for title
    $pdf->SetFont('helvetica', 'B', 14);

    $pdf->Ln(4); // Add some space before the line
    // Title
    $pdf->Cell(0, 15, $title, 0, 1, 'C');

    // Table Headers
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(60, 10, 'Nama Barang', 1); // Adjusted width
    $pdf->Cell(20, 10, 'Satuan', 1);
    $pdf->Cell(30, 10, 'Harga (Rp)', 1);
    $pdf->Cell(20, 10, 'Stok', 1);
    $pdf->Cell(50, 10, 'Updated At', 1); // Renamed to Updated At
    $pdf->Ln();

    // Table Content
    $pdf->SetFont('helvetica', '', 12);
    foreach ($data as $row) {
      $pdf->Cell(60, 10, $row['nama_barang'], 1); // Adjusted for long text
      $pdf->Cell(20, 10, $row['satuan'], 1);
      $pdf->Cell(30, 10, number_format($row['harga'], 2), 1);
      $pdf->Cell(20, 10, $row['stok'], 1);

      // Format updated_at
      $formattedDate = strftime('%e %B %Y, %H:%M', strtotime($row['updated_at']));
      $pdf->Cell(50, 10, $formattedDate, 1); // Renamed field
      $pdf->Ln();
    }

    // Tanda Tangan
    // Check if current Y position exceeds 8.2 inches (~208mm)
    if ($pdf->GetY() > 208) {
      // Add a new page if it exceeds
      $pdf->AddPage();
    }
    $pdf->Ln(10); // Add some space before the signature block

    // Add the signature text
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'Kepala UPTD. Laboratorium Kesehatan', 0, 0.8, 'R');
    $pdf->Cell(0, 7, 'Kabupaten Banjar', 0, 0.8, 'R');

    // Add space for signature
    $pdf->Ln(16); // Adjust the space as necessary

    // Add the name and NIP
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'Husnul Khatimah, SKM., M.Kes', 0, 0.8, 'R');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'NIP. 19740128 199303 2 004', 0, 0.8, 'R');

    // Close and output PDF document
    $pdf->Output($title . '.pdf', 'D');
  }
  public static function exportDataBarangMasuk($data)
  {
    $title = 'Data Barang Masuk';
    setlocale(
      LC_ALL,
      'id_ID.UTF8',
      'id_ID.UTF-8',
      'id_ID.8859-1',
      'id_ID',
      'IND.UTF8',
      'IND.UTF-8',
      'IND.8859-1',
      'IND',
      'Indonesian.UTF8',
      'Indonesian.UTF-8',
      'Indonesian.8859-1',
      'Indonesian',
      'Indonesia',
      'id',
      'ID',

      // Add english as default (if all Indonesian not available)
      'en_US.UTF8',
      'en_US.UTF-8',
      'en_US.8859-1',
      'en_US',
      'American',
      'ENG',
      'English',
    );

    // Create new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($title);
    $pdf->SetSubject('PDF Export');

    // Set footer fonts
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT); // Adjust top margin for header
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE,  PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Add header images and text
    $image1 = 'public/logo-1.png'; // Adjust path if necessary
    $image2 = 'public/logo-2.png'; // Adjust path if necessary

    // Adjust image size and position
    $pdf->Image($image1, 15, 15, 23); // left logo
    $pdf->Image($image2, 162, 20, 33); // right logo

    // Add header text
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'PEMERINTAH KABUPATEN BANJAR', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 7, 'DINAS KESEHATAN', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'UPTD. LABORATORIUM KESEHATAN DAERAH', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(0, 5, 'Jalan Pramuka Komplek Pangeran Antasari (Belakang POLRES Banjar) Martapura 70611', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Telp. (0511) 4720190 Email : labkesda.banjar@gmail.com', 0, 1, 'C');

    // Add a thick line below the header text (kop surat)
    $pdf->SetLineWidth(0.25); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 51, 195, 51); // Draw the line from left margin to right margin
    $pdf->SetLineWidth(0.5); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 52, 195, 52); // Draw the line from left margin to right margin

    // Set font for title
    $pdf->SetFont('helvetica', 'B', 14);

    $pdf->Ln(4); // Add some space before the line
    // Title
    $pdf->Cell(0, 15, $title, 0, 1, 'C');

    // Table Headers
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(60, 10, 'Nama Barang', 1); // Adjusted width
    $pdf->Cell(20, 10, 'Jumlah', 1);
    $pdf->Cell(30, 10, 'Admin', 1);
    $pdf->Cell(20, 10, 'Status', 1);
    $pdf->Cell(50, 10, 'Tanggal', 1); // Renamed to Updated At
    $pdf->Ln();

    // Table Content
    $pdf->SetFont('helvetica', '', 12);
    foreach ($data as $row) {
      $pdf->Cell(60, 10, $row['nama_barang'], 1); // Adjusted for long text
      $pdf->Cell(20, 10, $row['jumlah'], 1);
      $pdf->Cell(30, 10, $row['username'], 1);
      $pdf->Cell(20, 10, $row['status'], 1);

      // Format updated_at
      $formattedDate = strftime('%e %B %Y, %H:%M', strtotime($row['created_at']));
      $pdf->Cell(50, 10, $formattedDate, 1); // Renamed field
      $pdf->Ln();
    }
    // Check if current Y position exceeds 8.2 inches (~208mm)
    if ($pdf->GetY() > 208) {
      // Add a new page if it exceeds
      $pdf->AddPage();
    }
    $pdf->Ln(10); // Add some space before the signature block

    // Add the signature text
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'Kepala UPTD. Laboratorium Kesehatan', 0, 0.8, 'R');
    $pdf->Cell(0, 7, 'Kabupaten Banjar', 0, 0.8, 'R');

    // Add space for signature
    $pdf->Ln(16); // Adjust the space as necessary

    // Add the name and NIP
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'Husnul Khatimah, SKM., M.Kes', 0, 0.8, 'R');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'NIP. 19740128 199303 2 004', 0, 0.8, 'R');

    // Close and output PDF document
    $pdf->Output($title . '.pdf', 'D');
  }
  public static function exportDataBarangKeluar($data)
  {
    $title = 'Data Barang Keluar';
    setlocale(
      LC_ALL,
      'id_ID.UTF8',
      'id_ID.UTF-8',
      'id_ID.8859-1',
      'id_ID',
      'IND.UTF8',
      'IND.UTF-8',
      'IND.8859-1',
      'IND',
      'Indonesian.UTF8',
      'Indonesian.UTF-8',
      'Indonesian.8859-1',
      'Indonesian',
      'Indonesia',
      'id',
      'ID',

      // Add english as default (if all Indonesian not available)
      'en_US.UTF8',
      'en_US.UTF-8',
      'en_US.8859-1',
      'en_US',
      'American',
      'ENG',
      'English',
    );

    // Create new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($title);
    $pdf->SetSubject('PDF Export');

    // Set footer fonts
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT); // Adjust top margin for header
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE,  PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Add header images and text
    $image1 = 'public/logo-1.png'; // Adjust path if necessary
    $image2 = 'public/logo-2.png'; // Adjust path if necessary

    // Adjust image size and position
    $pdf->Image($image1, 15, 15, 23); // left logo
    $pdf->Image($image2, 162, 20, 33); // right logo

    // Add header text
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'PEMERINTAH KABUPATEN BANJAR', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 7, 'DINAS KESEHATAN', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'UPTD. LABORATORIUM KESEHATAN DAERAH', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(0, 5, 'Jalan Pramuka Komplek Pangeran Antasari (Belakang POLRES Banjar) Martapura 70611', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Telp. (0511) 4720190 Email : labkesda.banjar@gmail.com', 0, 1, 'C');

    // Add a thick line below the header text (kop surat)
    $pdf->SetLineWidth(0.25); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 51, 195, 51); // Draw the line from left margin to right margin
    $pdf->SetLineWidth(0.5); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 52, 195, 52); // Draw the line from left margin to right margin

    // Set font for title
    $pdf->SetFont('helvetica', 'B', 14);

    $pdf->Ln(4); // Add some space before the line
    // Title
    $pdf->Cell(0, 15, $title, 0, 1, 'C');

    // Table Headers
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(60, 10, 'Nama Barang', 1); // Adjusted width
    $pdf->Cell(20, 10, 'Jumlah', 1);
    $pdf->Cell(30, 10, 'Admin', 1);
    $pdf->Cell(20, 10, 'Status', 1);
    $pdf->Cell(50, 10, 'Tanggal', 1); // Renamed to Updated At
    $pdf->Ln();

    // Table Content
    $pdf->SetFont('helvetica', '', 12);
    foreach ($data as $row) {
      $pdf->Cell(60, 10, $row['nama_barang'], 1); // Adjusted for long text
      $pdf->Cell(20, 10, $row['jumlah'], 1);
      $pdf->Cell(30, 10, $row['username'], 1);
      $pdf->Cell(20, 10, $row['status'], 1);

      // Format updated_at
      $formattedDate = strftime('%e %B %Y, %H:%M', strtotime($row['created_at']));
      $pdf->Cell(50, 10, $formattedDate, 1); // Renamed field
      $pdf->Ln();
    }
    // Check if current Y position exceeds 8.2 inches (~208mm)
    if ($pdf->GetY() > 208) {
      // Add a new page if it exceeds
      $pdf->AddPage();
    }
    $pdf->Ln(10); // Add some space before the signature block

    // Add the signature text
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'Kepala UPTD. Laboratorium Kesehatan', 0, 0.8, 'R');
    $pdf->Cell(0, 7, 'Kabupaten Banjar', 0, 0.8, 'R');

    // Add space for signature
    $pdf->Ln(16); // Adjust the space as necessary

    // Add the name and NIP
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'Husnul Khatimah, SKM., M.Kes', 0, 0.8, 'R');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'NIP. 19740128 199303 2 004', 0, 0.8, 'R');

    // Close and output PDF document
    $pdf->Output($title . '.pdf', 'D');
  }

  public static function exportDataBarangRusak($data)
  {
    $title = 'Data Barang Rusak';
    setlocale(
      LC_ALL,
      'id_ID.UTF8',
      'id_ID.UTF-8',
      'id_ID.8859-1',
      'id_ID',
      'IND.UTF8',
      'IND.UTF-8',
      'IND.8859-1',
      'IND',
      'Indonesian.UTF8',
      'Indonesian.UTF-8',
      'Indonesian.8859-1',
      'Indonesian',
      'Indonesia',
      'id',
      'ID',
      'en_US.UTF8',
      'en_US.UTF-8',
      'en_US.8859-1',
      'en_US',
      'American',
      'ENG',
      'English'
    );

    // Create new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($title);
    $pdf->SetSubject('PDF Export');

    // Set footer fonts
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Add header images and text
    $image1 = 'public/logo-1.png'; // Adjust path if necessary
    $image2 = 'public/logo-2.png'; // Adjust path if necessary
    $pdf->Image($image1, 15, 15, 23); // left logo
    $pdf->Image($image2, 162, 20, 33); // right logo

    // Add header text
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'PEMERINTAH KABUPATEN BANJAR', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 7, 'DINAS KESEHATAN', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'UPTD. LABORATORIUM KESEHATAN DAERAH', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(0, 5, 'Jalan Pramuka Komplek Pangeran Antasari (Belakang POLRES Banjar) Martapura 70611', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Telp. (0511) 4720190 Email : labkesda.banjar@gmail.com', 0, 1, 'C');

    // Add a thick line below the header text (kop surat)
    $pdf->SetLineWidth(0.25);
    $pdf->Line(15, 51, 195, 51);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(15, 52, 195, 52);

    // Title
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Ln(4);
    $pdf->Cell(0, 15, $title, 0, 1, 'C');

    // Table Headers
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(60, 10, 'Nama Barang', 1);
    $pdf->Cell(30, 10, 'Foto', 1); // Increased width for the image
    $pdf->Cell(20, 10, 'Jumlah', 1);
    $pdf->Cell(20, 10, 'Admin', 1);
    $pdf->Cell(50, 10, 'Tanggal', 1);
    $pdf->Ln();

    // Table Content
    $pdf->SetFont('helvetica', '', 12);
    foreach ($data as $row) {
      $pdf->Cell(60, 30, $row['nama_barang'], 1); // Adjusted for long text

      // Add Image
      $imagePath = 'Uploads/' . $row['foto'];
      if (file_exists($imagePath)) {
        $pdf->Image($imagePath, $pdf->GetX() + 1, $pdf->GetY() + 1, 28); // Adjust size to fit the cell
      }
      $pdf->Cell(30, 30, '', 1); // Empty cell with border to match image size

      $pdf->Cell(20, 30, $row['jumlah_rusak'], 1);
      $pdf->Cell(20, 30, $row['username'], 1);

      // Format date
      $formattedDate = strftime('%e %B %Y, %H:%M', strtotime($row['created_at']));
      $pdf->Cell(50, 30, $formattedDate, 1);
      $pdf->Ln();
    }

    // Check page break
    if ($pdf->GetY() > 208) {
      $pdf->AddPage();
    }

    // Signature
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'Kepala UPTD. Laboratorium Kesehatan', 0, 0.8, 'R');
    $pdf->Cell(0, 7, 'Kabupaten Banjar', 0, 0.8, 'R');

    $pdf->Ln(16);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'Husnul Khatimah, SKM., M.Kes', 0, 0.8, 'R');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'NIP. 19740128 199303 2 004', 0, 0.8, 'R');

    // Output PDF
    $pdf->Output($title . '.pdf', 'D');
  }

  public static function exportDataBarangHabis($data)
  {
    $title = 'Data Barang Habis';
    setlocale(
      LC_ALL,
      'id_ID.UTF8',
      'id_ID.UTF-8',
      'id_ID.8859-1',
      'id_ID',
      'IND.UTF8',
      'IND.UTF-8',
      'IND.8859-1',
      'IND',
      'Indonesian.UTF8',
      'Indonesian.UTF-8',
      'Indonesian.8859-1',
      'Indonesian',
      'Indonesia',
      'id',
      'ID',

      // Add english as default (if all Indonesian not available)
      'en_US.UTF8',
      'en_US.UTF-8',
      'en_US.8859-1',
      'en_US',
      'American',
      'ENG',
      'English',
    );

    // Create new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($title);
    $pdf->SetSubject('PDF Export');

    // Set footer fonts
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT); // Adjust top margin for header
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE,  PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Add header images and text
    $image1 = 'public/logo-1.png'; // Adjust path if necessary
    $image2 = 'public/logo-2.png'; // Adjust path if necessary

    // Adjust image size and position
    $pdf->Image($image1, 15, 15, 23); // left logo
    $pdf->Image($image2, 162, 20, 33); // right logo

    // Add header text
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'PEMERINTAH KABUPATEN BANJAR', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 7, 'DINAS KESEHATAN', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'UPTD. LABORATORIUM KESEHATAN DAERAH', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(0, 5, 'Jalan Pramuka Komplek Pangeran Antasari (Belakang POLRES Banjar) Martapura 70611', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Telp. (0511) 4720190 Email : labkesda.banjar@gmail.com', 0, 1, 'C');

    // Add a thick line below the header text (kop surat)
    $pdf->SetLineWidth(0.25); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 51, 195, 51); // Draw the line from left margin to right margin
    $pdf->SetLineWidth(0.5); // Set the line thickness to 0.5mm (adjust as needed)
    $pdf->Line(15, 52, 195, 52); // Draw the line from left margin to right margin

    // Set font for title
    $pdf->SetFont('helvetica', 'B', 14);

    $pdf->Ln(4); // Add some space before the line
    // Title
    $pdf->Cell(0, 15, $title, 0, 1, 'C');

    // Table Headers
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(130, 10, 'Nama Barang', 1); // Adjusted width
    $pdf->Cell(50, 10, 'Tanggal', 1); // Renamed to Updated At
    $pdf->Ln();

    // Table Content
    $pdf->SetFont('helvetica', '', 12);
    foreach ($data as $row) {
      $pdf->Cell(130, 10, $row['nama_barang'], 1); // Adjusted for long text

      // Format updated_at
      $formattedDate = strftime('%e %B %Y, %H:%M', strtotime($row['created_at']));
      $pdf->Cell(50, 10, $formattedDate, 1); // Renamed field
      $pdf->Ln();
    }
    // Check if current Y position exceeds 8.2 inches (~208mm)
    if ($pdf->GetY() > 208) {
      // Add a new page if it exceeds
      $pdf->AddPage();
    }
    $pdf->Ln(10); // Add some space before the signature block

    // Add the signature text
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'Kepala UPTD. Laboratorium Kesehatan', 0, 0.8, 'R');
    $pdf->Cell(0, 7, 'Kabupaten Banjar', 0, 0.8, 'R');

    // Add space for signature
    $pdf->Ln(16); // Adjust the space as necessary

    // Add the name and NIP
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 7, 'Husnul Khatimah, SKM., M.Kes', 0, 0.8, 'R');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 7, 'NIP. 19740128 199303 2 004', 0, 0.8, 'R');

    // Close and output PDF document
    $pdf->Output($title . '.pdf', 'D');
  }
}