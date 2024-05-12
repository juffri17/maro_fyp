<?php
require_once('tcpdf/tcpdf.php');
include 'database.php';

if (isset($_GET['ic']) && isset($_GET['id'])) {
    $ic = $_GET['ic'];
    $id = $_GET['id'];

    ob_clean();

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('PDF_' . $ic);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->AddPage();

    // Fetch data from form1
    $query_form1 = "SELECT * FROM form1 WHERE ic = '$ic' AND id = '$id'";
    $result_form1 = mysqli_query($conn, $query_form1);

    if ($result_form1 && mysqli_num_rows($result_form1) > 0) {
        $row_form1 = mysqli_fetch_assoc($result_form1);
        // Add form1 data to PDF
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'PDF of form submitted at ' . $row_form1['created_at'], 0, 1, 'C');
        $pdf->Cell(0, 10, 'IC: ' . $row_form1['ic'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $row_form1['email'], 0, 1);
        $pdf->Cell(0, 10, 'Jabatan/Unit: ' . $row_form1['jabatan_unit'], 0, 1);
    }

    // Fetch data from form2
    $query_form2 = "SELECT * FROM form2 WHERE ic = '$ic' AND id = '$id'";
    $result_form2 = mysqli_query($conn, $query_form2);

    if ($result_form2 && mysqli_num_rows($result_form2) > 0) {
        $row_form2 = mysqli_fetch_assoc($result_form2);
        // Add form2 data to PDF
        $pdf->Cell(0, 10, 'Perkhidmatan: ' . $row_form2['perkhidmatan'], 0, 1);
    }

    // Fetch data from form2a
    $query_form2a = "SELECT * FROM form2a WHERE ic = '$ic' AND id = '$id'";
    $result_form2a = mysqli_query($conn, $query_form2a);

    if ($result_form2a && mysqli_num_rows($result_form2a) > 0) {
        $row_form2a = mysqli_fetch_assoc($result_form2a);
        // Add form2a data to PDF
        $pdf->Cell(0, 10, 'Jenis Perkhidmatan: ' . $row_form2a['perkhidmatan'], 0, 1);
    }

    // Fetch data from form3a
    $query_form3a = "SELECT * FROM form3a WHERE ic = '$ic' AND id = '$id'";
    $result_form3a = mysqli_query($conn, $query_form3a);

    if ($result_form3a && mysqli_num_rows($result_form3a) > 0) {
        $row_form3a = mysqli_fetch_assoc($result_form3a);
        // Add form3a data to PDF
        $pdf->Cell(0, 10, 'Nama Acara: ' . $row_form3a['nama_acara'], 0, 1);
        $pdf->Cell(0, 10, 'Lokasi Acara: ' . $row_form3a['lokasi_acara'], 0, 1);
        $pdf->Cell(0, 10, 'Tarikh Acara: ' . $row_form3a['tarikh_acara'], 0, 1);
        $pdf->Cell(0, 10, 'Masa Acara: ' . $row_form3a['masa_acara'], 0, 1);
    }

    // Fetch data from form4a
    $query_form4a = "SELECT * FROM form4a WHERE ic = '$ic' AND id = '$id'";
    $result_form4a = mysqli_query($conn, $query_form4a);

    if ($result_form4a && mysqli_num_rows($result_form4a) > 0) {
        $row_form4a = mysqli_fetch_assoc($result_form4a);
        // Add form4a data to PDF
        $pdf->Cell(0, 10, 'Tarikh Raptai: ' . $row_form4a['tarikh_raptai'], 0, 1);
        $pdf->Cell(0, 10, 'Masa Raptai: ' . $row_form4a['masa_raptai'], 0, 1);
    }

    $pdf->Output($ic . '.pdf', 'I');
    exit();
}
?>
