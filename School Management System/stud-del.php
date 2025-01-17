<?php
include 'connection.php';

if (isset($_GET["id"])) {
    $StudentID = $_GET["id"];

    // Delete the student
    $query = "DELETE FROM student WHERE StudentID='$StudentID'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Deleted Successfully');</script>";
    } else {
        echo "<script>alert('Error deleting data: " . mysqli_error($conn) . "');</script>";
    }
}
header("Location: stud-read.php");
exit();
?>
