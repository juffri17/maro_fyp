<?php
session_start();
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Unit Head</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .approve-button {
            background-color: #4caf50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .approve-button:hover {
            background-color: #45a049;
        }
        .reject-button {
            background-color: red;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .reject-button:hover {
            background-color: brown;
        }
    </style>
</head>
<body>

<h2>Dashboard - Unit Head</h2>

<table>
    <thead>
        <tr>
            <th>IC</th>
            <th>Email</th>
            <th>Created At</th>
            <th>View</th>
            <th>Person In Charge</th>
            <th>Approval Status</th>
            <th>Approve</th>
            <th>Reject</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through form2a data
        $form2a_query = "SELECT * FROM form2a";
        $form2a_result = mysqli_query($conn, $form2a_query);    
        while ($row = mysqli_fetch_assoc($form2a_result)) {
            echo "<tr>";
            echo "<td>" . $row['ic'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>";
            // Button to generate and download PDF
            echo "<a href='maro_pdf1.php?ic=" . $row["ic"] . "&id=" . $row["id"] . "'>View the PDF</a>";
            // echo "<br></br>";
            // echo "<a href='view_status.php?ic=" . $row["ic"] . "'>View Approval Status</a>";
            echo "</td>";
            $pic = $row['pic'];
            $status = $row['approval_status'];

            echo "<td>";
            echo $pic !== '' ? $pic : "Not Assigned yet";
            echo "</td>";

            echo "<td>";
            if ($status == 0) {
                echo "<span style='color: brown;'>No Response</span>";
            } elseif ($status == 1) {
                echo "<span style='color: blue;'>PIC Decline</span>";
            } elseif ($status == 2) {
                echo "<span style='color: red;'>Unit Head Reject</span>";
            } elseif ($status == 3) {
                echo "<span style='color: orange;'>Unit Head Approve Process</span>";
            } elseif ($status == 4) {
                echo "<span style='color: green;'>PIC Accept</span>";
            } else {
                echo "No response";
            }
            echo "</td>";

            echo "<td><button class='approve-button' onclick='approveEntry1(" . $row['id'] . ")'>Approve</button></td>";
            echo "<td><button class='reject-button' onclick='rejectEntry1(" . $row['id'] . ")'>Reject</button></td>";
            echo "</tr>";
        }

        $form2b_query = "SELECT * FROM form2b";
        $form2b_result = mysqli_query($conn, $form2b_query);
        // Loop through form2b data
        while ($row = mysqli_fetch_assoc($form2b_result)) {
            echo "<tr>";
            echo "<td>" . $row['ic'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>";
            // Button to generate and download PDF
            echo "<a href='maro_pdf2.php?ic=" . $row["ic"] . "&id=" . $row["id"] . "'>View the PDF</a>";
            // echo "<br></br>";
            // echo "<a href='view_status.php?ic=" . $row["ic"] . "'>View Approval Status</a>";
            echo "</td>";
            $pic = $row['pic'];
            $status = $row['approval_status'];

            echo "<td>";
            echo $pic ?? "Not Assigned yet";

            echo "</td>";

            echo "<td>";
            if ($status == 0) {
                echo "<span style='color: brown;'>No Response</span>";
            } elseif ($status == 1) {
                echo "<span style='color: blue;'>PIC Decline</span>";
            } elseif ($status == 2) {
                echo "<span style='color: red;'>Unit Head Reject</span>";
            } elseif ($status == 3) {
                echo "<span style='color: orange;'>Unit Head Approve Process</span>";
            } elseif ($status == 4) {
                echo "<span style='color: green;'>PIC Accept</span>";
            } else {
                echo "No response";
            }
            echo "</td>";
            echo "<td><button class='approve-button' onclick='approveEntry2(" . $row['id'] . ")'>Approve</button></td>";
            echo "<td><button class='reject-button' onclick='rejectEntry2(" . $row['id'] . ")'>Reject</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function approveEntry1(id) {
    $.post('approve_entry1.php', { id: id }, function(response) {
        alert(response);
    });
}
function approveEntry2(id) {
    $.post('approve_entry2.php', { id: id }, function(response) {
        alert(response);
    });
}
function rejectEntry1(id) {
    $.post('reject_entry1.php', { id: id }, function(response) {
        alert(response);
    });
}
function rejectEntry2(id) {
    $.post('reject_entry2.php', { id: id }, function(response) {
        alert(response);
    });
}

</script>

</body>
</html>
