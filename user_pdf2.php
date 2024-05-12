<?php
require_once('tcpdf/tcpdf.php');
include 'database.php';
session_start();

$ic = $_SESSION['ic'];
$email = $_SESSION['email'];

ob_clean();

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('PDF_' . $ic);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

// Fetch data from form1
$query_form1 = "SELECT * FROM form1 WHERE ic = '$ic' AND email = '$email'";
$result_form1 = mysqli_query($conn, $query_form1);
$row_form1 = mysqli_fetch_assoc($result_form1);

// Add form1 data to PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'PDF of form submitted at ' . $row_form1['created_at'], 0, 1, 'C');

$pdf->Cell(0, 10, 'IC: ' . $row_form1['ic'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $row_form1['email'], 0, 1);
$pdf->Cell(0, 10, 'Jabatan/Unit: ' . $row_form1['jabatan_unit'], 0, 1);

// Fetch data from form2
$query_form2 = "SELECT * FROM form2 WHERE ic = '$ic' AND email = '$email'";
$result_form2 = mysqli_query($conn, $query_form2);
$row_form2 = mysqli_fetch_assoc($result_form2);

$pdf->Cell(0, 10, 'Perkhidmatan: ' . $row_form2['perkhidmatan'], 0, 1);

// Fetch data from form2b
$query_form2b = "SELECT * FROM form2b WHERE ic = '$ic' AND email = '$email'";
$result_form2b = mysqli_query($conn, $query_form2b);
$row_form2b = mysqli_fetch_assoc($result_form2b);

// Add form2b data to PDF
$pdf->Cell(0, 10, 'Tugasan Kerja: ' . $row_form2b['tugasan_kerja'], 0, 1);
$pdf->Cell(0, 10, 'Saiz: ' . $row_form2b['saiz'], 0, 1);
$pdf->Cell(0, 10, 'Konsep: ' . $row_form2b['konsep'], 0, 1);
$pdf->Cell(0, 10, 'Perkataan: ' . $row_form2b['perkataan'], 0, 1);
$pdf->Cell(0, 10, 'Durasi Video: ' . $row_form2b['durasi_video'], 0, 1);

// Fetch data from form3a
$query_form3a = "SELECT * FROM form3b WHERE ic = '$ic' AND email = '$email'";
$result_form3a = mysqli_query($conn, $query_form3a);
$row_form3a = mysqli_fetch_assoc($result_form3a);

// Add form3a data to PDF
$pdf->Cell(0, 10, 'Nama Acara: ' . $row_form3a['nama_acara'], 0, 1);
$pdf->Cell(0, 10, 'Lokasi Acara: ' . $row_form3a['lokasi_acara'], 0, 1);
$pdf->Cell(0, 10, 'Tarikh Acara: ' . $row_form3a['tarikh_acara'], 0, 1);
$pdf->Cell(0, 10, 'Masa Acara: ' . $row_form3a['masa_acara'], 0, 1);

// Fetch data from form4a
$query_form4a = "SELECT * FROM form4b WHERE ic = '$ic' AND email = '$email'";
$result_form4a = mysqli_query($conn, $query_form4a);
$row_form4a = mysqli_fetch_assoc($result_form4a);

// Add form4a data to PDF
$pdf->Cell(0, 10, 'Tarikh Raptai: ' . $row_form4a['tarikh_raptai'], 0, 1);
$pdf->Cell(0, 10, 'Masa Raptai: ' . $row_form4a['masa_raptai'], 0, 1);

$pdf->Output($ic . '.pdf', 'I');
exit();
?>
