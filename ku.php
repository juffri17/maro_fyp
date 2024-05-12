<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ketua Unit Page</title>
<style>
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
    .yellow {
        background-color: yellow;
    }
    .red {
        background-color: red;
    }
    .blue {
        background-color: blue;
    }
    .green {
        background-color: green;
    }
    .super-admin-button {
        background-color: #4caf50;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }
    .super-admin-button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<h1>Welcome, Ketua Unit!</h1>

<!-- Requests Table -->
<div id="requestTable">
    <table>
        <thead>
            <tr>
                <th>Request No.</th>
                <th>Approval</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Request rows will be dynamically added here -->
            <tr>
                <td>Request 1 - Assigned to PIC 1</td>
                <td>
                    <select id="approvalSelect1" onchange="changeStatus(1)">
                        <option value="approve">Approve</option>
                        <option value="reject">Reject</option>
                    </select>
                </td>
                <td id="status1" class="yellow">On Process</td>
            </tr>
        </tbody>
    </table>
</div>

<button class="super-admin-button" onclick="redirectToSuperAdmin()">Super Admin</button>

<script>
// Function to change status based on approval
function changeStatus(requestId) {
    const approvalSelect = document.getElementById(`approvalSelect${requestId}`);
    const statusCell = document.getElementById(`status${requestId}`);
    if (approvalSelect.value === 'approve') {
        statusCell.textContent = 'PIC Accepted';
        statusCell.className = 'blue';
    } else {
        statusCell.textContent = 'Declined';
        statusCell.className = 'red';
    }
}

// Function to redirect to Super Admin page
function redirectToSuperAdmin() {
    window.location.href = 'super_admin.php';
}
</script>

</body>
</html>
