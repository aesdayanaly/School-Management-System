<?php
require 'connection.php';

// Check if department ID is provided
if(isset($_GET['department_id'])) {
    $departmentId = $_GET['department_id'];
    // Fetch majors for the given department ID
    $majorsResult = $conn->query("SELECT MajorName FROM major WHERE DepartmentID = $departmentId");
    $majors = [];
    if ($majorsResult->num_rows > 0) {
        while ($row = $majorsResult->fetch_assoc()) {
            $majors[] = $row['MajorName'];
        }
        // Output majors as JSON
        echo json_encode($majors);
    } else {
        echo json_encode(['error' => 'No majors found for the selected department.']);
    }
} else {
    echo json_encode(['error' => 'Department ID not provided.']);
}
?>
