<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $DepartmentID = $_GET['id'];

    // Validate the input
    $DepartmentID = htmlspecialchars($DepartmentID);

    // Check if DepartmentID exists in the database
    $checkQuery = "SELECT * FROM department WHERE DepartmentID = '$DepartmentID'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Delete the department
        $query = "DELETE FROM department WHERE DepartmentID = '$DepartmentID'";
        if (mysqli_query($conn, $query)) {
            header("Location: department-read.php?msg=Department deleted successfully");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "DepartmentID does not exist.";
    }
} else {
    echo "No DepartmentID provided.";
}
?>
