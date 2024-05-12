<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['ic']) && isset($_SESSION['email'])) {
        $ic = $_SESSION['ic'];
        $email = $_SESSION['email'];

        $nama_acara = mysqli_real_escape_string($conn, $_POST["nama_acara"]);
        $lokasi_acara = mysqli_real_escape_string($conn, $_POST["lokasi_acara"]);
        $tarikh_acara = $_POST["tarikh_acara"];
        $masa_acara = $_POST["masa_acara"];

        $query = "INSERT INTO form3a (ic, email, nama_acara, lokasi_acara, tarikh_acara, masa_acara)
                  VALUES ('$ic', '$email', '$nama_acara', '$lokasi_acara', '$tarikh_acara', '$masa_acara')";

        if (mysqli_query($conn, $query)) {
            header("Location: user4a.php");
            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Session data (IC and/or email) not found.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Isikan butiran-butiran acara/majlis/program yang akan dilaksanakan</title>
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
    input[type="date"],
    input[type="time"] {
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
    <h2>Isikan butiran-butiran acara/majlis/program yang akan dilaksanakan</h2>
    <form action="#" method="post">
        <label for="nama_acara">Nama Acara/Majlis/Program:</label>
        <input type="text" id="nama_acara" name="nama_acara" required>
        <span class="note">Isikan nama penuh acara/majlis/program.</span>

        <label for="lokasi_acara">Lokasi Acara/Majlis/Program:</label>
        <input type="text" id="lokasi_acara" name="lokasi_acara">
        <span class="note">Isikan lokasi acara/majlis/program diadakan (Jika berkaitan).</span>

        <label for="tarikh_acara">Tarikh Acara/Majlis/Program:</label>
        <input type="date" id="tarikh_acara" name="tarikh_acara" required>
        <span class="note">Isikan tarikh acara/majlis/program yang akan dijalankan. *Untuk kerja grafik, masukkan tarikh kerja tersebut diperlukan.</span>

        <label for="masa_acara">Masa Acara/Majlis/Program:</label>
        <input type="time" id="masa_acara" name="masa_acara" required>
        <span class="note">Isikan masa acara/majlis/program akan dijalankan. *Untuk kerja grafik, masukkan tarikh kerja tersebut diperlukan.</span>

        <div class="buttons">
            <a href="user2a.php" class="previous-button">Previous</a>
            <button type="submit" class="next-button">Next</button>
        </div>
    </form>
</div>

</body>
</html>
