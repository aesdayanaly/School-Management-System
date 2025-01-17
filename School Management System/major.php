<?php
require 'connection.php';

// Fetch departments from the `department` table
$departmentQuery = "SELECT DepartmentID, DepartmentName FROM department";
$departmentResult = mysqli_query($conn, $departmentQuery);

if (isset($_POST["submit"])) {
    $MajorID = $_POST["MajorID"];
    $DepartmentID = $_POST["DepartmentID"];
    $MajorName = $_POST["MajorName"];

    // Validate and sanitize inputs
    $MajorID = htmlspecialchars($MajorID);
    $DepartmentID = htmlspecialchars($DepartmentID);
    $MajorName = htmlspecialchars($MajorName);

    // Check for errors
    $errors = [];
    if (empty($MajorID)) $errors[] = "Major ID is required.";
    if (empty($DepartmentID)) $errors[] = "Department ID is required.";
    if (empty($MajorName)) $errors[] = "Major Name is required.";

    if (empty($errors)) {
        // Insert data into the `major` table
        $query = "INSERT INTO major (MajorID, DepartmentID, MajorName) VALUES ('$MajorID', '$DepartmentID', '$MajorName')";
        mysqli_query($conn, $query);
        header("Location: major-read.php?msg=Data added successfully");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Major</title>
</head>
<body>
<button type="back" name="back" class="backBtn">
    <a href="major-read.php" class=" uil-arrow-left"></a>
</button>
<div class="container">
    <form action="#" method="post">
        <div class="form first">
            <div class="details personal">
                <span class="title">Major Details</span>
                <div class="fields">
                    <div class="input-field">
                        <label>Major ID</label>
                        <input type="number" name="MajorID" placeholder="Enter the Major ID" required>
                    </div>
                    <div class="input-field">
                        <label>Department ID</label>
                        <select name="DepartmentID" required>
                            <option value="" disabled selected>Select Department</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($departmentResult)) {
                                echo "<option value='" . htmlspecialchars($row['DepartmentID']) . "'>" . htmlspecialchars($row['DepartmentID']) . " - " . htmlspecialchars($row['DepartmentName']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="input-field">
                        <label>Major Name</label>
                        <input type="text" name="MajorName" placeholder="Enter the major name" required>
                    </div>
                    <button type="submit" name="submit" class="nextBtn">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
                <?php
                if (!empty($errors)) {
                    echo "<div class='errors'>";
                    foreach ($errors as $error) {
                        echo "<p>" . htmlspecialchars($error) . "</p>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </form>
</div>
</body>
</html>
