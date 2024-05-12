<!DOCTYPE html>
<?php

session_start();
include 'database.php';
require_once('tcpdf/tcpdf.php');

?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PIC Page</title>
<style>
    /* Add your CSS styling here */
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    .green {
        background-color: green;
    }
    .red {
        background-color: red;
    }
    .file-icon {
        cursor: pointer;
    }
    /* Hide the file input */
    #fileInput {
        display: none;
    }
    .upload-note {
        text-align: center;
        margin-bottom: 10px;
        font-style: italic;
        color: #666;
        display: none;
    }
</style>
</head>
<body>
<h1>Welcome, PIC!</h1>

<!-- Task Table -->
<div id="taskTable">
    <table>
        <thead>
            <tr>
                <th>Task No.</th>
                <th>Task Details</th>
                <th>Acceptance</th>
                <th>Reason for Declining</th>
                <th>File Upload</th>
                <th>Completion</th>
            </tr>
        </thead>
        <tbody id="taskRows">
            <!-- Task rows will be dynamically added here -->
			
			<?php

//echo $_SESSION['name'];

$sql2 = "SELECT form2.*, form2a.*, form3a.*, form4a.* , form2.perkhidmatan as perkhidmatans, form2a.id as ids
FROM form2 
LEFT JOIN form2a ON form2.ic = form2a.ic 
LEFT JOIN form3a ON form2.ic = form3a.ic 
LEFT JOIN form4a ON form2.ic = form4a.ic 
LEFT JOIN user ON form2.ic = user.ic 
WHERE (form2.perkhidmatan = 'audio_visual' and form2a.pic = '".$_SESSION['name']."') OR (form2.perkhidmatan = 'kerja_grafik_multimedia' and form2a.pic = '".$_SESSION['name']."')";
//echo $sql2;
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><?php echo $no; ?></td>
  <td><a href='maro_pdf1.php?ic=<?php echo $row["ic"]; ?>&id=<?php echo $row["id"]; ?>'>Download PDF</a></td>

            <td>
			<?php if ($row['approval_status'] != '2') { ?>
                <select onchange="handleChange(this.value, '<?php echo $row["ic"]; ?>', 'audio_visual')">
								<option value="">Please Choose</option>

    <option value="4" <?php if ($row['approval_status'] == '4') echo 'selected'; ?>>Approve</option>
    <option value="1" <?php if ($row['approval_status'] == '1') echo 'selected'; ?>>Reject</option>
</select>
			<?php }?>

			<script>
				function handleChange(status, ic, perkhidmatan) {
					var confirmation;
					if (status === '4') {
						confirmation = confirm("Are you sure you want to approve this request?");
						if (confirmation) {
							// Redirect to update_status.php with parameters in the URL
							window.location.href = "update_status.php?ic=" + ic + "&perkhidmatan=" + perkhidmatan + "&status=4";
						}
					} else if (status === '1') {
						confirmation = confirm("Are you sure you want to reject this request?");
						if (confirmation) {
							// Redirect to update_status.php with parameters in the URL
							window.location.href = "update_status.php?ic=" + ic + "&perkhidmatan=" + perkhidmatan + "&status=1";
						}
					}
				}
			</script>

            </td>
            <td><input type="text" id="reasonInput1" style="display: none;"></td>
            <td>
			<?php if($row['path_file'] != '') {?>
			<a href="uploads/<?php echo $row['path_file'];?>"><?php echo $row['path_file'];?></a>
			
			<?php } else {?>
			<form action="update_file.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf" onchange="handleFileUpload(event, <?php echo $taskId; ?>)">
    <input type="hidden" name="taskId" value="<?php echo $row["ids"]; ?>">
    <input type="submit" value="Submit File">
</form>
			<?php } ?>
</td>
            <td>
						<?php if ($row['approval_status'] != '2') {

//echo 		$row['perkhidmatans'];					?>

<button onclick='completeRequest("<?php echo $row["ic"]; ?>", "<?php echo $row["perkhidmatans"]; ?>")'>Complete</button>
						<?php } else {?>
						Completed
						<?php } ?>

			</td>
        </tr>
<?php
        $no++;
    }
}
?>

           
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

<!-- Hidden file input element -->

<!-- Note displayed when Decline is selected -->
<div id="noteDiv" class="upload-note">
    Note: Only PDF files with a size between 100 KB and 1 MB can be uploaded.
</div>

<script>
// Function to toggle reason input based on acceptance
function toggleInputs(taskId) {
    const acceptanceSelect = document.getElementById(`acceptanceSelect${taskId}`);
    const reasonInput = document.getElementById(`reasonInput${taskId}`);
    const uploadButton = document.getElementById(`uploadButton${taskId}`);
    const noteDiv = document.getElementById('noteDiv');

    if (acceptanceSelect.value === 'decline') {
        reasonInput.style.display = 'block';
        uploadButton.style.display = 'inline-block';
        noteDiv.style.display = 'block';
    } else {
        reasonInput.style.display = 'none';
        uploadButton.style.display = 'none';
        noteDiv.style.display = 'none';
    }
}

function handleFileUpload(event, taskId) {
    const fileInput = event.target;
    const files = fileInput.files;
    const fileSize = files[0].size / 1024; // Convert to KB

    if (files.length > 0 && files[0].type === 'application/pdf' && fileSize >= 100 && fileSize <= 1024) {
        // File meets criteria, proceed with form submission
		        alert(`Uploading file: ${files[0].name} for task ${taskId}`);

        fileInput.closest('form').submit();
    } else {
        alert('Please upload a PDF file with a size between 100 KB and 1 MB.');
        fileInput.value = ''; // Clear the file input
    }
}


// Function to mark task as completed
function completeTask(taskId, button) {
    // Change completion status and color
    button.textContent = 'Completed';
    button.style.backgroundColor = 'green';
    button.style.color = 'white'; // Change text color to white
    button.style.fontWeight = 'bold'; // Make text bold
    button.disabled = true;
}

function completeRequest(ic, perkhidmatan) {
    var confirmation = confirm("Are you sure you want to mark this request as complete?");
    if (confirmation) {
        // Redirect to update_status.php with parameters in the URL
        window.location.href = "completeemail.php?ic=" + ic + "&perkhidmatan=" + perkhidmatan + "&status=2";
    }
}
</script>

</body>
</html>
