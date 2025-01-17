<?php
$conn = mysqli_connect("localhost", "root", "", "system");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
