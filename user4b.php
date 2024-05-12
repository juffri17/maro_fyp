<?php

session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ic = $_SESSION['ic'];
    $email = $_SESSION['email'];
    $tarikh_raptai = $_POST["tarikh_raptai"];
    $masa_raptai = $_POST["masa_raptai"];

    $sql = "INSERT INTO form4b (ic, email, tarikh_raptai, masa_raptai) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ic, $email, $tarikh_raptai, $masa_raptai);

    if ($stmt->execute()) {
        // echo "New record inserted successfully";
        echo "<script>alert('Form is submitted'); window.location.replace('user_pdf2.php');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
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
        width: calc(100% - 22px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
        display: inline-block;
    }
    .note {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
        display: block;
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
    .review-message {
        margin-top: 20px;
        text-align: center;
        color: #888;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Butiran Raptai Acara/Majlis/Program</h2>
    <form action="user4b.php" method="post">
        <label for="tarikh_raptai">Tarikh Raptai:</label>
        <input type="date" id="tarikh_raptai" name="tarikh_raptai" required>
        <span class="note">Isikan tarikh raptai acara/majlis/program yang akan dijalankan (Jika berkaitan).</span>

        <label for="masa_raptai">Masa Raptai:</label>
        <input type="time" id="masa_raptai" name="masa_raptai" required>
        <span class="note">Isikan masa raptai acara/majlis/program yang akan dijalankan (Jika berkaitan).</span>

        <div class="buttons">
            <a href="user3b.php" class="previous-button">Previous</a>
            <button type="submit" class="next-button">Submit</button>
        </div>
    </form>

    <p class="review-message">Your request will be reviewed within 3 days.</p>
</div>

</body>
</html>
