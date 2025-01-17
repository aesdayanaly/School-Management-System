<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $CourseID = trim($_POST["CourseID"]);
    $CourseName = trim($_POST["CourseName"]);
    $Credits = trim($_POST["Credits"]);

    // Validate inputs
    $errors = [];
    if (empty($CourseID) || !preg_match('/^\d+$/', $CourseID)) {
        $errors[] = "Invalid Course ID.";
    }
    if (empty($CourseName) || !preg_match('/^[A-Za-z\s]+$/', $CourseName)) {
        $errors[] = "Invalid Course Name.";
    }
    if (empty($Credits) || !preg_match('/^\d+$/', $Credits)) {
        $errors[] = "Invalid Credits.";
    }

    // Check for errors
    if (empty($errors)) {
        $query = "INSERT INTO course (CourseID, CourseName, Credits) VALUES ('$CourseID', '$CourseName', '$Credits')";
        if (mysqli_query($conn, $query)) {
            header("Location: read.php?msg=Data added successfully");
            exit;
        } else {
            $errors[] = "Error inserting data: " . mysqli_error($conn);
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
    <link rel="stylesheet" href="student.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Course</title>
</head>
<body>
<button type="back" name="back" class="backBtn">
    <a href="read.php" class="uil-arrow-left"></a>
</button>
<div class="container">
    <form action="#" method="post">
        <div class="form first">
            <div class="details personal">
                <span class="title">Course Details</span>
                <div class="fields">
                    <div class="input-field">
                        <label>Course ID</label>
                        <input type="number" name="CourseID" placeholder="Enter the course ID" required>
                    </div>
                    <div class="input-field">
                        <label>Course Name</label>
                        <input type="text" name="CourseName" placeholder="Enter the course name" required>
                    </div>
                    <div class="input-field">
                        <label>Credits</label>
                        <input type="text" name="Credits" placeholder="Enter the credits" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="nextBtn">
                    <span class="btnText">Submit</span>
                    <i class="uil uil-navigator"></i>
                </button>
            </div>
        </div>
    </form>
    <?php
    if (!empty($errors)) {
        echo '<div class="error-messages">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
    }
    ?>
</div>
</body>
</html>
