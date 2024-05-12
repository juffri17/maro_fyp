<?php
// Assuming you have a database connection established already
// Replace "your_database_connection.php" with your actual file or code to establish a connection to the database
include 'database.php';

// Check if IC, status, and perkhidmatan are set in the POST request
if(isset($_REQUEST['ic']) && isset($_REQUEST['status']) && isset($_REQUEST['perkhidmatan'])) {
    // Sanitize input
    $ic = mysqli_real_escape_string($conn, $_REQUEST['ic']);
    $status = mysqli_real_escape_string($conn, $_REQUEST['status']);
    $perkhidmatan = mysqli_real_escape_string($conn, $_REQUEST['perkhidmatan']);
    
    // Determine the appropriate table based on the perkhidmatan value
    switch ($perkhidmatan) {
        case 'audio_visual':
            $table = 'form2a';
            break;
        case 'kerja_grafik_multimedia':
            $table = 'form2b';
            break;
        default:
            // If perkhidmatan is not recognized, exit with an error message
            echo "Invalid perkhidmatan";
            exit;
    }
    
    // Check if IC exists in the specified table
    $sql_check_ic = "SELECT * FROM $table WHERE ic = '$ic'";
    $result_check_ic = mysqli_query($conn, $sql_check_ic);
    
    if(mysqli_num_rows($result_check_ic) > 0) {
        // Update approval status in the appropriate table
        $sql_update = "UPDATE $table SET approval_status = '$status' WHERE ic = '$ic'";
        
        // Perform the update
        if(mysqli_query($conn, $sql_update)) {
            // If the query was successful, send a success response
            echo "<script>alert('Status updated successfully');</script>";
            header("Location: pic.php");
        } else {
            // If there was an error with the query, send an error response
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        // IC not found in the specified table
        echo "IC not found";
    }
} else {
    // If IC, status, and perkhidmatan are not set in the POST request, send an error response
    echo "IC, status, and perkhidmatan are required";
}

?>
