<?php
include "connection.php";
$id = $_GET["id"]; // Getting the MajorID from the URL
$sql = "DELETE FROM major WHERE MajorID = '$id'"; // Using the correct variable name
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: major-read.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
