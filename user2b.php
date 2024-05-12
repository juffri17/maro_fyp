<?php
session_start();
include 'database.php';

// Check if session variables are set
if (!isset($_SESSION['ic']) || !isset($_SESSION['email'])) {
    die("<script>alert('Session data (IC and/or email) not found.');</script>");
}

$ic = $_SESSION['ic'];
$email = $_SESSION['email'];

$gambar_logo = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tugasan_kerja = mysqli_real_escape_string($conn, $_POST["tugasan_kerja"]);
    $saiz = mysqli_real_escape_string($conn, $_POST["saiz"]);
    $konsep = mysqli_real_escape_string($conn, $_POST["konsep"]);
    $perkataan = mysqli_real_escape_string($conn, $_POST["perkataan"]);
    $durasi_video = mysqli_real_escape_string($conn, $_POST["durasi_video"]);

    // Check if file was uploaded successfully
    if(isset($_FILES['gambar_logo'])) {
        if ($_FILES['gambar_logo']['error'] !== UPLOAD_ERR_OK) {
            die("Upload failed with error code: " . $_FILES['gambar_logo']['error']);
        }
    
        $filename = $_FILES['gambar_logo']['name'];
        $temp_location = $_FILES['gambar_logo']['tmp_name'];
        $upload_directory = 'uploads/';
        $unique_filename = uniqid() . '_' . $filename;
        $file_path = $upload_directory . $unique_filename;
    
        if(move_uploaded_file($temp_location, $file_path)) {
            $gambar_logo = mysqli_real_escape_string($conn, $file_path);
        } else {
            die("<script>alert('Failed to upload file.');</script>");
        }
    } else {
        echo "File is not set.";
    }
    
    // Prepare and execute SQL query
    $query = "INSERT INTO form2b (ic, email, tugasan_kerja, saiz, konsep, perkataan, durasi_video, gambar_logo)
              VALUES ('$ic', '$email', '$tugasan_kerja', '$saiz', '$konsep', '$perkataan', '$durasi_video', '$gambar_logo')";

    if (mysqli_query($conn, $query)) {
        mysqli_close($conn);
        echo "<script>window.location.replace('user3b.php');</script>";
    } else {
        die("<script>alert('Error: " . mysqli_error($conn) . "');</script>");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Isikan Butiran Kerja Grafik / Multimedia dibawah</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    h2 {
        text-align: center;
    }
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="file"] {
        width: calc(100% - 20px); /* Adjust for border width */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
    .note {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
    }
    .buttons {
        text-align: right;
        margin-top: 20px;
    }
    .next-button,
    .previous-button {
        background-color: #4caf50;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .next-button {
        float: right;
    }
    .previous-button {
        float: left;
    }
    .next-button:hover,
    .previous-button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Isikan Butiran Kerja Grafik / Multimedia dibawah</h2>
    <form action="user2b.php" method="post" enctype="multipart/form-data">
        <label for="tugasan_kerja">Tugasan Kerja Grafik / Multimedia:</label>
        <select id="tugasan_kerja" name="tugasan_kerja">
            <option value="banner">Banner</option>
            <option value="bunting">Bunting</option>
            <option value="poster">Poster</option>
            <option value="backdrop">Backdrop</option>
            <option value="video_multimedia">Video / Multimedia</option>
            <option value="other">Other</option>
        </select>
        <span class="note">Isikan tugasan kerja grafik yang diperlukan. Sila ambil maklum bagi setiap kerja grafik yang dilaksanakan, hanya perubahan minor sahaja yang boleh dibuat dan tidak melebihi TIGA (3) kali perubahan.</span>

        <label for="saiz">Saiz yang diperlukan:</label>
        <input type="text" id="saiz" name="saiz">
        <span class="note">Isikan saiz banner, banting, poster, backdrop yang diperlukan (Jika berkaitan).</span>

        <label for="konsep">Konsep/tema/warna:</label>
        <input type="text" id="konsep" name="konsep">
        <span class="note">Isikan konsep/tema/warna yang dikehendaki bagi kerja grafik/multimedia yang diperlukan.</span>

        <label for="perkataan">Perkataan/ayat lengkap:</label>
        <input type="text" id="perkataan" name="perkataan">
        <span class="note">Isikan perkataan atau ayat lengkap yang perlu dimasukkan dalam kerja grafik.</span>

        <label for="durasi_video">Durasi video:</label>
        <input type="text" id="durasi_video" name="durasi_video">
        <span class="note">Isikan durasi video yang diperlukan jika permohonan melibatkan kerja penyuntingan video/multimedia. Tinggalkan kosong jika tidak berkaitan.</span>

        <label for="gambar_logo">Gambar/logo:</label>
        <input type="file" id="gambar_logo" name="gambar_logo">
        <span class="note">Perincian gambar atau logo yang diperlukan. Pemohon perlu serahkan gambar/logo kepada pereka dalam format dan saiz yang sesuai.</span>

        <div class="buttons">
            <a href="user1.php#" class="previous-button">Previous</a>
            <button type="submit" class="next-button">Next</button>
        </div>
    </form>
</div>

</body>
</html>