<?php

session_start();
include 'database.php';
$ic = $_SESSION['ic'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['ic']) && isset($_SESSION['email'])) {
        $ic = $_SESSION['ic'];
        $email = $_SESSION['email'];

        if (isset($_POST["perkhidmatan"]) && !empty($_POST["perkhidmatan"])) {
            $perkhidmatan = mysqli_real_escape_string($conn, $_POST["perkhidmatan"]);

            $query = "INSERT INTO form2 (ic, email, perkhidmatan) VALUES ('$ic', '$email', '$perkhidmatan')";

            if (mysqli_query($conn, $query)) {
                if ($perkhidmatan === 'audio_visual') {
                    echo "<script>window.location.replace('user2a.php');</script>";
                    exit();
                } else {
                    echo "<script>window.location.replace('user2b.php');</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Please select a service.');</script>";
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
<title>BORANG PERMOHONAN PERKHIDMATAN UIDM</title>
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
    input[type="radio"] {
        margin-right: 10px;
    }
    .buttons {
        text-align: right;
    }
    .next-button,
    .previous-button {
        background-color: #4caf50;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
    }
    .next-button:hover,
    .previous-button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="container">
    <h2>BORANG PERMOHONAN PERKHIDMATAN UIDM</h2>
    <p>Sila pilih perkhidmatan yang diperlukan. Sekiranya anda memerlukan perkhidmatan rakaman foto digital, video atau audio, pilih Audio Visual. Sekiranya anda memerlukan perkhidmatan kerja grafik (banner, backdrop dll) dan multimedia (montaj dll), pilih Kerja Grafik / Multimedia.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>
            <input type="radio" name="perkhidmatan" value="audio_visual"> Audio Visual
        </label>
        <label>
            <input type="radio" name="perkhidmatan" value="kerja_grafik_multimedia"> Kerja Grafik / Multimedia
        </label>
        <div class="buttons">
            <button type="submit" class="next-button">Next</button>
        </div>
    </form>
</div>

</body>
</html>