<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"]) && isset($_POST["taskId"])) {
    $taskId = $_POST["taskId"];


    // Process file upload
    $targetDir = "uploads/";
	$filename =  $_FILES["fileToUpload"]["name"];
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1024 * 1024) { // 1 MB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only PDF files
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, update database
            $sqlUpdateForm2a = "UPDATE form2a SET path_file = '$filename' 
                                WHERE id = '$taskId'";

            $resultUpdateForm2a = mysqli_query($conn, $sqlUpdateForm2a);
            if(!$resultUpdateForm2a) {
                // Handle update error
                echo "Error updating form2a record: " . mysqli_error($conn);
            } else {
                echo "File uploaded and database updated successfully.";
				  echo "<script>alert('File uploaded and database updated successfully.');</script>";
				            header("Location: pic.php");
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Invalid request.";
}
?>
