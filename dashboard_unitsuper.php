<?php
session_start();
include 'database.php';
$ic = $_SESSION['ic'];
$email = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["role"])) {
    $role = $_POST["role"];
    
    if ($role === "unit_head") {
        header("Location: dashboard_unithead.php");
        exit();
    } elseif ($role === "super_admin") {
        header("Location: dashboard_superadmin.php");
        exit();
    }
} else {
    // header("Location: login.php");
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Unit or Super Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        label {
            display: inline-block;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Choose your role:</h2>
    <form action="#" method="post">
        <input type="radio" id="unit_head" name="role" value="unit_head">
        <label for="unit_head">Unit Head</label><br>
        <input type="radio" id="super_admin" name="role" value="super_admin">
        <label for="super_admin">Super Admin</label><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
