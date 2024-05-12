<?php
session_start();
include 'database.php';

if(isset($_SESSION['ic'])) {
    $ic = $_SESSION['ic'];

    $query = "SELECT * FROM user WHERE ic = '$ic'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email']; 

        echo "<h1>Welcome, $email</h1>";
    } else {
        echo "<h1>User not found</h1>";
    }
} else {
    echo "<h1>Access denied</h1>";
    header("Location: login.php");
    exit();
}

// Define jabatan/unit options
$jabatan_unit_options = array(
    "JKA" => "JABATAN KEJURUTERAAN AWAM",
    "JKE" => "JABATAN ELEKTRIK KEJURUTERAAN",
    "JKM" => "JABATAN MEKANIKAL KEJURUTERAAN",
    "JP" => "JABATAN PERDAGANGAN",
    "JKP" => "JABATAN PERKAPALAN KEJURUTERAAN",
    "JMSK" => "JABATAN MATEMATIK, SAINS DAN KOMPUTER",
    "JTMK" => "JABATAN TEKNOLOGI MAKLUMAT DAN KOMUNIKASI",
    "JSKK" => "JABATAN SUKAN, KOKURIKULUM & KEBUDAYAAN",
    "JPA" => "JABATAN PENGAJIAN AM",
    "PIP" => "PUSAT ISLAM PUO",
    "HEP" => "JABATAN HAL EHWAL PELAJAR",
    "UKK" => "UNIT KOMUNIKASI KORPORAT",
    "UP" => "UNIT PENTADBIRAN",
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["jabatan_unit"]) && !empty($_POST["jabatan_unit"])) {
        $jabatan_unit = mysqli_real_escape_string($conn, $_POST["jabatan_unit"]);

        if(isset($_SESSION['ic'])) {
            $ic = $_SESSION['ic'];

            $query = "INSERT INTO form1 (ic, email, jabatan_unit) VALUES ('$ic', '$email', '$jabatan_unit')";

            if(mysqli_query($conn, $query)) {
                header("Location: user1.php");
                exit;
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Session data (IC) not found.');</script>";
        }
    } else {
        echo "<script>alert('Please select a Jabatan/Unit.');</script>";
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
    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="jabatan_unit">Jabatan/Unit:</label>
        <select id="jabatan_unit" name="jabatan_unit" required>
            <option value="">Select Jabatan/Unit</option>
            <?php foreach ($jabatan_unit_options as $key => $value): ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
        
        <div class="buttons">
            <a href="user1.php" class="previous-button" style="display:none">Previous</a>
            <button type="submit" class="next-button">Next</button>
        </div>
    </form>
</div>

</body>
</html>
