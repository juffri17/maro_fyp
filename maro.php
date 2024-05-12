<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maro's Page</title>
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
    .green {
        background-color: green;
    }
    .blue {
        background-color: blue;
    }
    .red {
        background-color: red;
    }
    .yellow {
        background-color: yellow;
    }
</style>
</head>
<body>
<h1>Welcome, Maro!</h1>

<!-- Request Table -->
<div id="requestTable">
    <table>
        <thead>
            <tr>
                <th>Request No.</th>
                <th>PIC Assigned</th>
                <th>Submit to KU</th>
                <th>Approval Status</th>
            </tr>
        </thead>
        <tbody id="requestRows">
           
        </tbody>
    </table>
</div>

<script>
// Dummy data for PICs
const picData = [
    { name: "AHMAD SYAWAL BIN YEOP AZIZ(KG)", workWeightage: 0 },
    { name: "ANIS BIN IBRAHIM(VIDEOGRAPHER)", workWeightage: 0 },
    { name: "AZMIN BIN AZLAN(VIDEOGRPHER)", workWeightage: 0 },
    { name: "MUSHAYRI B. YAHYA(AV)", workWeightage: 0 },
    { name: "NICHOLAS NESAMUTHU(AV)", workWeightage: 0 },
    { name: "NURLIYANA AMIRAH BT NADZARI(KG)", workWeightage: 0 },
    { name: "RONNIE BIN BAHARI(PHOTOGRAPHER)", workWeightage: 0 },
    { name: "SHARIFAH ZULIANA BINTI SYED MOHAMED(PHOTOGRAPHER)", workWeightage: 0 }
];

// Dummy data for requests
const requestData = [
    { id: 1, pic: null, status: "yellow" },
    { id: 2, pic: null, status: "yellow" },
    { id: 3, pic: null, status: "yellow" },
    { id: 4, pic: null, status: "yellow" },
    { id: 5, pic: null, status: "yellow" }
];

// Populate the request table
const requestTable = document.getElementById("requestRows");
requestData.forEach(request => {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td>${request.id}</td>
        <td>
            <select id="picSelect${request.id}" onchange="updateWeightage(${request.id})">
                <option value="">Select PIC</option>
                ${picData.map(pic => `<option value="${pic.name}">${pic.name} (${pic.workWeightage})</option>`).join('')}
            </select>
        </td>
        <td><button onclick="submitToKU(${request.id})">Submit</button></td>
        <td id="approvalStatus${request.id}" class="${request.status}">${getStatusText(request.status)}</td>
    `;
    requestTable.appendChild(row);
});

// Function to update weightage based on PIC selection
function updateWeightage(requestId) {
    const picSelect = document.getElementById(`picSelect${requestId}`);
    const selectedPic = picSelect.value;
    const picDataIndex = picData.findIndex(pic => pic.name === selectedPic);
    if (picDataIndex !== -1) {
        // Calculate new work weightage
        const currentWeightage = picData[picDataIndex].workWeightage;
        const assignedRequests = requestData.filter(req => req.pic === selectedPic && req.status !== 'green').length;
        const newWeightage = currentWeightage - assignedRequests;
        picData[picDataIndex].workWeightage = newWeightage;
        // Update select option text
        picSelect.options[picSelect.selectedIndex].text = `${selectedPic} (${newWeightage})`;
    }
}

// Function to get text for approval status
function getStatusText(status) {
    switch (status) {
        case "green":
            return "Completed by PIC";
        case "blue":
            return "Declined by PIC";
        case "red":
            return "Declined by Unit Head";
        case "yellow":
            return "On process";
        default:
            return "";
    }
}

function submitToKU(requestId) {
    // Dummy implementation - Replace with actual submission logic
    const approvalStatusCell = document.getElementById(`approvalStatus${requestId}`);
    approvalStatusCell.textContent = "Yellow (On process)";
    approvalStatusCell.className = "yellow";
}
</script>

</body>
</html>