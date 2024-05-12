<?php

session_start();
include 'database.php';
$ic = $_SESSION['ic'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['ic']) && isset($_SESSION['email'])) {
        $ic = $_SESSION['ic'];
        $email = $_SESSION['email'];

        if(isset($_POST["perkhidmatan"]) && !empty($_POST["perkhidmatan"])) {
            $perkhidmatan_values = array_map(function ($value) use ($conn) {
                return mysqli_real_escape_string($conn, $value);
            }, $_POST["perkhidmatan"]);

            $perkhidmatan = implode(", ", $perkhidmatan_values);

            $query = "INSERT INTO form2a (ic, email, perkhidmatan) VALUES ('$ic', '$email', '$perkhidmatan')";

            if(mysqli_query($conn, $query)) {
                header("Location: user3a.php");
                exit();
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Please select a service.');</script>";
        }
    } else {
        echo "<script>alert('Session data (IC and/or email) not found.');</script>";
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Butiran perkhidmatan bagi rakaman Foto Digital, Video & Audio</title>
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
    input[type="checkbox"] {
        margin-right: 10px;
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
    <h2>Butiran perkhidmatan bagi rakaman Foto Digital, Video & Audio</h2>
    <form action="#" method="post">
        <label>Pilih perkhidmatan yang diperlukan (Boleh pilih lebih dari 1):</label>
        <label><input type="checkbox" name="perkhidmatan[]" value="rakaman_foto_digital"> Rakaman Foto Digital</label>
        <label><input type="checkbox" name="perkhidmatan[]" value="rakaman_video"> Rakaman Video</label>
        <label><input type="checkbox" name="perkhidmatan[]" value="perkhidmatan_audio"> Perkhidmatan Audio</label>
        <label><input type="checkbox" name="perkhidmatan[]" value="other"> Other</label>
        <div class="buttons">
            <a href="user1.php" class="previous-button">Previous</a>
            <button type="submit" class="next-button">Next</button>
        </div>
    </form>
</div>


</body>
</html>

