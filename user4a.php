<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['ic']) && isset($_SESSION['email'])) {
        $ic = $_SESSION['ic'];
        $email = $_SESSION['email'];

        $tarikh_raptai = $_POST["tarikh_raptai"];
        $masa_raptai = $_POST["masa_raptai"];

        $query = "INSERT INTO form4a (ic, email, tarikh_raptai, masa_raptai)
                  VALUES ('$ic', '$email', '$tarikh_raptai', '$masa_raptai')";

        // $query = "select * from form1 where ic = '$ic'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Form is submitted'); window.location.replace('user_pdf1.php');</script>";
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
<title>Butiran Raptai Acara/Majlis/Program</title>
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
    input[type="date"],
    input[type="time"] {
        width: calc(100% - 20px); /* Adjust for border width */
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
    .submit-button,
    .previous-button {
        background-color: #4caf50;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .submit-button {
        float: right;
    }
    .previous-button {
        float: left;
    }
    .submit-button:hover,
    .previous-button:hover {
        background-color: #45a049;
    }
    .review-message {
        margin-top: 20px;
        text-align: center;
        font-style: italic;
        color: #888;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Butiran Raptai Acara/Majlis/Program</h2>
    <form action="#" method="post">
        <label for="tarikh_raptai">Tarikh Raptai:</label>
        <input type="date" id="tarikh_raptai" name="tarikh_raptai">
        <span class="note">Isikan tarikh raptai acara/majlis/program yang akan dijalankan (Jika berkaitan).</span>

        <label for="masa_raptai">Masa Raptai:</label>
        <input type="time" id="masa_raptai" name="masa_raptai">
        <span class="note">Isikan masa raptai acara/majlis/program yang akan dijalankan (Jika berkaitan).</span>

        <div class="buttons">
            <a href="user3a.php" class="previous-button">Previous</a>
            <button type="submit" class="submit-button">Submit</button>
        </div>
    </form>

    <p class="review-message">Your request will be reviewed within 3 days.</p>
</div>

</body>
</html>
