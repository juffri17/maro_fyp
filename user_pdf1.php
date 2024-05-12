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

// Add IC data to PDF
$pdf->Cell(40, 10, 'IC:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form1['ic'], 'LTRB', 1, 'L');

// Add Email data to PDF
$pdf->Cell(40, 10, 'Email:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form1['email'], 'LTRB', 1, 'L');

// Add Jabatan/Unit data to PDF
$pdf->Cell(40, 10, 'Jabatan/Unit:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form1['jabatan_unit'], 'LTRB', 1, 'L');


// Fetch data from form2
$query_form2 = "SELECT * FROM form2 WHERE ic = '$ic' AND email = '$email'";
$result_form2 = mysqli_query($conn, $query_form2);
$row_form2 = mysqli_fetch_assoc($result_form2);

// Add form2 data to PDF
$pdf->Cell(40, 10, 'Perkhidmatan:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form2['perkhidmatan'], 'LTRB', 1, 'L');

// Fetch data from form2a
$query_form2a = "SELECT * FROM form2a WHERE ic = '$ic' AND email = '$email'";
$result_form2a = mysqli_query($conn, $query_form2a);
$row_form2a = mysqli_fetch_assoc($result_form2a);

// Add form2a data to PDF
$pdf->Cell(40, 10, 'Jenis Perkhidmatan:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form2a['perkhidmatan'], 'LTRB', 1, 'L');

// Fetch data from form3a
$query_form3a = "SELECT * FROM form3a WHERE ic = '$ic' AND email = '$email'";
$result_form3a = mysqli_query($conn, $query_form3a);
$row_form3a = mysqli_fetch_assoc($result_form3a);

// Add form3a data to PDF
$pdf->Cell(40, 10, 'Nama Acara:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form3a['nama_acara'], 'LTRB', 1, 'L');

$pdf->Cell(40, 10, 'Lokasi Acara:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form3a['lokasi_acara'], 'LTRB', 1, 'L');

$pdf->Cell(40, 10, 'Tarikh Acara:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form3a['tarikh_acara'], 'LTRB', 1, 'L');

$pdf->Cell(40, 10, 'Masa Acara:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form3a['masa_acara'], 'LTRB', 1, 'L');

// Fetch data from form4a
$query_form4a = "SELECT * FROM form4a WHERE ic = '$ic' AND email = '$email'";
$result_form4a = mysqli_query($conn, $query_form4a);
$row_form4a = mysqli_fetch_assoc($result_form4a);

// Add form4a data to PDF
$pdf->Cell(40, 10, 'Tarikh Raptai:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form4a['tarikh_raptai'], 'LTRB', 1, 'L');

$pdf->Cell(40, 10, 'Masa Raptai:', 'LTRB', 0, 'L');
$pdf->Cell(0, 10, $row_form4a['masa_raptai'], 'LTRB', 1, 'L');


$pdf->Output($ic . '.pdf', 'I');
exit();
?>
