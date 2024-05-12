<?php
require "./phpmailer/PHPMailerAutoload.php";
session_start();
include 'database.php';

if(isset($_REQUEST['ic'])) {
	$ic = $_REQUEST['ic'];
	$email = $_SESSION['email'];
	$perkhidmatan = $_REQUEST['perkhidmatan'];
	
	// Update status in form2a table where perkhidmatan matches form2
    $sqlUpdateForm2a = "UPDATE form2a SET approval_status = 2 
                        WHERE ic = '$ic' 
                        AND EXISTS (SELECT 1 FROM form2 WHERE form2.ic = form2a.ic AND form2.perkhidmatan = '$perkhidmatan')";
    
    $resultUpdateForm2a = mysqli_query($conn, $sqlUpdateForm2a);
    // Send email notification
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'dineshegas@outlook.com'; 
            $mail->Password = 'Hegasdines_04'; 

            $mail->setFrom('dineshegas@outlook.com', 'Complete Task Notification');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Complete Task Notification";
            $mail->Body = "<p>Dear user, User IC: $ic has been completed task ($perkhidmatan).</p>";

            if(!$mail->send()){
                echo "Error sending email: " . $mail->ErrorInfo;
            } else {
              //  echo "Request approved successfully. Email notification sent.";
								            echo "<script>alert('Task Completed. Email notify successfully');</script>";
				            header("Location: pic.php");

            }
} else {
    echo "ID not provided";
}
?>
