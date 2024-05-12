<?php 
session_start();
include('database.php');

if(isset($_POST["reset-request"])){
    $email = mysqli_real_escape_string($connect, $_POST["email"]); // Sanitize the input

    // Query the database for the provided email
    $check_query = mysqli_query($connect, "SELECT * FROM user WHERE Email = '$email'");

    if(mysqli_num_rows($check_query) > 0){
        // If email exists in the database, send the OTP
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
            echo "<script>alert('OTP sent to $email'); window.location.replace('verification.php');</script>";
        }
    }else{
        // If the email does not exist in the database, alert the user
        echo "<script>alert('Invalid Email. No registered account found with that email address.');</script>";
    }
}
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Forgot Password</title>
</head>

<body>
    <main>
        <div class="container">
            <h2>Reset Password</h2>
            <form action="" method="POST">
                <input type="email" name="email" required placeholder="Enter Your Email">
                <button type="submit" name="reset-request">Send Reset Link</button>
            </form>
        </div>
    </main>
</body>
</html>
