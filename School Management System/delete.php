<?php
include "connection.php";
$id = $_GET["id"]; // Getting the CourseID from the URL
$sql = "DELETE FROM course WHERE CourseID = '$id'"; // Using the correct variable name
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: read.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
