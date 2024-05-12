<?php
session_start();
include 'database.php';

if(isset($_POST["sendCodeButton"])){
    $email = mysqli_real_escape_string($conn, $_POST["email"]); 

    $check_query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if ($check_query === false) {
        echo "Query error: " . mysqli_error($conn);
    } else {
        if(mysqli_num_rows($check_query) == 0) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;

            require "./phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'dineshegas@outlook.com'; 
            $mail->Password = 'Hegasdines_04'; 

            $mail->setFrom('dineshegas@outlook.com', 'OTP Verification');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Your verify code";
            $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>";

            if(!$mail->send()){
                echo "<script>alert('Failed to send OTP.');</script>";
            }else{
                $_SESSION['verification_code'] = $otp;
                echo "<script>alert('OTP sent to email: " . htmlspecialchars($email) . "');</script>";
            }
        } else {
            echo "<script>alert('Email already exists.');</script>";
        }
    }
}

if(isset($_POST["submitRegistration"])) {
    $entered_verification_code = mysqli_real_escape_string($conn, $_POST["verificationCode"]);

    if(isset($_SESSION['verification_code']) && $entered_verification_code == $_SESSION['verification_code']) {
        $icNumber = mysqli_real_escape_string($conn, $_POST["icNumber"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $name = mysqli_real_escape_string($conn, $_POST["name"]);

        if($_POST["password"] !== $_POST["confirmPassword"]) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user (ic, email, password, name) VALUES ('$icNumber', '$email', '$hashedPassword', '$name')";
            $result = mysqli_query($conn, $query);

            if($result) {
                echo "<script>alert('Registration successful.');</script>";
                unset($_SESSION['verification_code']);
                echo "<script>window.location.replace('login.php');</script>";
            } else {
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }
        }
    } else {
        echo "<script>alert('Incorrect verification code. Please try again.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 3px;
        background-color: green; 
        color: #fff;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #006400; 
    }
</style>
</head>
<body>

<div class="container">
    <h2>User Registration</h2>
    <form id="registrationForm" action="#" method="post">
        <label for="icNumber">IC Number:</label>
        <input type="text" id="icNumber" name="icNumber" value="<?php if(isset($_POST['icNumber'])) { echo htmlspecialchars($_POST['icNumber']); } ?>" required>

        <label for="icNumber">Name:</label>
        <input type="text" id="name" name="name" value="<?php if(isset($_POST['name'])) { echo htmlspecialchars($_POST['name']); } ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) { echo htmlspecialchars($_POST['email']); } ?>" required>
        


        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php if(isset($_POST['password'])) { echo htmlspecialchars($_POST['password']); } ?>" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" value="<?php if(isset($_POST['confirmPassword'])) { echo htmlspecialchars($_POST['confirmPassword']); } ?>" required>

        <button type="submit" id="sendCodeButton" name="sendCodeButton">Send Code</button>

        <label for="verificationCode">Verification Code:</label>
        <input type="text" id="verificationCode" name="verificationCode">

        <input type="submit" value="Register" name="submitRegistration">
    </form>
</div>
</body>
</html>
