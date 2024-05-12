<?php

if (isset($_POST['ic']) && isset($_POST['pic'])) {
    $ic = $_POST['ic'];
    $pic = $_POST['pic'];

    include 'database.php';

    $updateQuery = "UPDATE form2a SET pic = ? WHERE ic = ?";
    $statement = $conn->prepare($updateQuery);
    $statement->bind_param("ss", $pic, $ic);

    if ($statement->execute()) {
        echo "PIC updated successfully";
        echo "<script>alert('PIC updated successfully');</script>";
    } else {
        echo "Error: Unable to update PIC";
    }

    $statement->close();
    $conn->close();
} else {
    echo "Error: IC and PIC values are not set";
}
?>
