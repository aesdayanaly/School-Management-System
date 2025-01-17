<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $DepartmentID = $_POST["DepartmentID"];
    $DepartmentName = $_POST["DepartmentName"];
    $Location = $_POST["Location"];

    // Data validation
    $errors = [];

    if (empty($DepartmentID)) {
        $errors[] = "Department ID is required.";
    } elseif (!is_numeric($DepartmentID)) {
        $errors[] = "Department ID must be a number.";
    }

    if (empty($DepartmentName)) {
        $errors[] = "Department Name is required.";
    }

    if (empty($Location)) {
        $errors[] = "Location is required.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO department (DepartmentID, DepartmentName, Location) VALUES ('$DepartmentID', '$DepartmentName', '$Location')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data Inserted Successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="student.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Department</title>
</head>

<body>
<button type="back" name="back" class="backBtn">
    <a href="depar-read.php" class=" uil-arrow-left"></a>
</button>
<div class="container">

    <form action="#" method="post">
        <div class="form first">
            <div class="details personal">
                <span class="title">Department Details</span>

                <div class="fields">
                    <div class="input-field">
                        <label>Department ID</label>
                        <input type="number" name="DepartmentID" placeholder="Enter the department ID" required>
                    </div>

                    <div class="input-field">
                        <label>Department Name</label>
                        <input type="text" name="DepartmentName" placeholder="Enter the department name" required>
                    </div>

                    <div class="input-field">
                        <label>Location</label>
                        <input type="text" name="Location" placeholder="Enter the department location" required>
                    </div>

                    <button type="submit" name="submit" class="nextBtn">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>

</html>
