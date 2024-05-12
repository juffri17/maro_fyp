<?php
require "./phpmailer/PHPMailerAutoload.php";
session_start();
include 'database.php';

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Update the approval status in the database
    $update_query = "UPDATE form2b SET approval_status = 2 WHERE id = '$id'";

    if(mysqli_query($conn, $update_query)) {
        // Retrieve email of the user associated with the request
        $email_query = "SELECT * FROM form2b WHERE id = '$id'";
        $email_result = mysqli_query($conn, $email_query);

        if($email_result && mysqli_num_rows($email_result) > 0) {
            $row = mysqli_fetch_assoc($email_result);
            $email = $row['email'];
            $ic = $row['ic'];

            // Send email notification
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'YOUREMAIL@outlook.com'; 
            $mail->Password = 'YOURPWD'; 

            $mail->setFrom('YOUREAIL@outlook.com', 'Kerja Grafik Multimedia Rejection Notification');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Request Rejection Notification";
            $mail->Body = "<p><p>Dear user (IC: $ic), your Kerja Grafik Multimedia request has been rejected.</p>";

            if(!$mail->send()){
                echo "Error sending email: " . $mail->ErrorInfo;
            } else {
                echo "Request rejected successfully. Email notification sent.";
            }
        } else {
            echo "No user found with the specified ID.";
        }
    } else {
        echo "Error updating entry: " . mysqli_error($conn);
    }
} else {
    echo "ID not provided";
}
?>
