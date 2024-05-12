<?php

session_start();
include 'database.php';
require_once('tcpdf/tcpdf.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maro Dashboard</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    #myChart {
        position: relative;
    }

    #legend-container {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
    }

    #legend-container ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #legend-container ul li {
        display: inline-block;
        margin-right: 10px;
    }
</style>
</head>

<body>

<h2>Maro Dashboard  (Requests)</h2>

<h3>Audio Visual</h3>
<table>
<tr>
    <th>IC</th>
    <th>Email</th>
    <th>Assigned PIC</th>
    <th>Action</th>
    <th>Approval Status</th>
</tr>
<?php
$sql2 = "SELECT form2.*, form2a.*, form3a.*, form4a.* 
FROM form2 
LEFT JOIN form2a ON form2.ic = form2a.ic 
LEFT JOIN form3a ON form2.ic = form3a.ic 
LEFT JOIN form4a ON form2.ic = form4a.ic 
LEFT JOIN user ON form2.ic = user.ic 
WHERE form2.perkhidmatan = 'audio_visual';
";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ic"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>";
        echo "<select name='pic_assigned'>";
        if ($row["pic"] == null) {
            echo "<option value=''>Select PIC</option>";
            $pic_query = "SELECT * FROM pic";
            $pic_result = mysqli_query($conn, $pic_query);
            if ($pic_result) {
                while ($pic_row = mysqli_fetch_assoc($pic_result)) {
                    echo "<option value='" . $pic_row["name"] . "'>" . $pic_row["name"] . "</option>";

                }
            echo "</select>";
            echo "<button onclick='updatePIC1(" . $row["ic"] . ", this)'>Submit</button>";

            } else {
                echo "Error fetching PIC options: " . mysqli_error($conn);
                echo "</select>";

            }
        }else {
            echo "<option value='" . $row["pic"] . "' selected>" . $row["pic"] . "</option>";
        }


        echo "</td>";
        echo "<td>";
        // Button to generate and download PDF
        echo "<a href='maro_pdf1.php?ic=" . $row["ic"] . "&id=" . $row["id"] . "'>Download PDF</a>";
        // echo "<br></br>";
        // echo "<a href='view_status.php?ic=" . $row["ic"] . "'>View Approval Status</a>";
        echo "</td>";
        echo "<td>";
        $status = $row["approval_status"];
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
        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data available</td></tr>";
}
?>
</table>

<h3>Kerja Grafik Multimedia</h3>
<table>
<tr>
    <th>IC</th>
    <th>Email</th>
    <th>Assigned PIC</th>
    <th>Action</th>
    <th>Approval Status</th>
</tr>
<?php
$sql2 = "SELECT form2.*, form2b.*, form3b.*, form4b.* 
FROM form2 
LEFT JOIN form2b ON form2.ic = form2b.ic 
LEFT JOIN form3b ON form2.ic = form3b.ic 
LEFT JOIN form4b ON form2.ic = form4b.ic 
LEFT JOIN user ON form2.ic = user.ic 
WHERE form2.perkhidmatan = 'kerja_grafik_multimedia';
";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ic"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>";
        echo "<select name='pic_assigned'>";
        if ($row["pic"] == null) {
            echo "<option value=''>Select PIC</option>";
            $pic_query = "SELECT * FROM pic";
            $pic_result = mysqli_query($conn, $pic_query);
            if ($pic_result) {
                while ($pic_row = mysqli_fetch_assoc($pic_result)) {
                    echo "<option value='" . $pic_row["name"] . "'>" . $pic_row["name"] . "</option>";

                }
            echo "</select>";
            echo "<button onclick='updatePIC2(" . $row["ic"] . ", this)'>Submit</button>";

            } else {
                echo "Error fetching PIC options: " . mysqli_error($conn);
                echo "</select>";

            }
        }else {
            echo "<option value='" . $row["pic"] . "' selected>" . $row["pic"] . "</option>";
        }


        echo "</td>";
        echo "<td>";
        // Button to generate and download PDF
        echo "<a href='maro_pdf2.php?ic=" . $row["ic"] . "&id=" . $row["id"] . "'>Download PDF</a>";
        // echo "<br></br>";
        // echo "<a href='view_status.php?ic=" . $row["ic"] . "'>View Approval Status</a>";
        echo "</td>";
        echo "<td>";
        $status = $row["approval_status"];
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
        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data available</td></tr>";
}
?>

</table>

<?php

$pics = array();
$counts = array();

$sql_form2a = "SELECT DISTINCT pic FROM form2a";
$result_form2a = mysqli_query($conn, $sql_form2a);

$sql_form2b = "SELECT DISTINCT pic FROM form2b";
$result_form2b = mysqli_query($conn, $sql_form2b);

$all_pics = array();

while ($row_form2a = mysqli_fetch_assoc($result_form2a)) {
    $all_pics[] = $row_form2a['pic'];
}

while ($row_form2b = mysqli_fetch_assoc($result_form2b)) {
    $all_pics[] = $row_form2b['pic'];
}

$unique_pics = array_unique($all_pics);

foreach ($unique_pics as $pic) {
    $sql_count = "SELECT COUNT(*) AS count FROM (SELECT pic, approval_status FROM form2a UNION ALL SELECT pic, approval_status FROM form2b) AS combined_forms WHERE pic = '$pic' and approval_status = '4'";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $counts[] = $row_count['count'];
    $pics[] = $pic;
}

?>
<canvas id="myChart" width="200" height="200" style="max-height: 400px;"></canvas>

<script>
    // Get data from PHP arrays
    var pics = <?php echo json_encode($pics); ?>;
    var counts = <?php echo json_encode($counts); ?>;

    // Create a new Chart object
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: pics, // PIC names
            datasets: [{
                label: 'Count',
                data: counts, // Counts for each PIC
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false // Hide the default legend
            }
        }
    });
</script>

<script>

function updatePIC1(ic, button) {
        var selectedPIC = button.previousElementSibling.value; 
        console.log(ic);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    button.innerText = 'Submitted';
                    button.disabled = true;
                } else {
                    // Handle error
                    console.error('Error:', xhr.responseText);
                }
            }
        };
        xhr.open('POST', 'update_pic1.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('ic=' + ic + '&pic=' + selectedPIC);
    }

    function updatePIC2(ic, button) {
        var selectedPIC = button.previousElementSibling.value; // Get the selected PIC value
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    button.innerText = 'Submitted';
                    button.disabled = true;
                } else {
                    console.error('Error:', xhr.responseText);
                }
            }
        };
        xhr.open('POST', 'update_pic2.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('ic=' + ic + '&pic=' + selectedPIC);
    }
</script>


</body>
</html>