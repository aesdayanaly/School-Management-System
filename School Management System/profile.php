<?php
session_start();
require 'connection.php';

// Check if the student is logged in
if (!isset($_SESSION['StudentID'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in student's ID
$StudentID = $_SESSION['StudentID'];

// Fetch student information
$query = "
    SELECT student.StudentID, student.FirstName, student.LastName, student.Email, student.Birthday, major.MajorName, department.DepartmentName
    FROM student
    JOIN major ON student.MajorID = major.MajorID
    JOIN department ON major.DepartmentID = department.DepartmentID
    WHERE student.StudentID = '$StudentID'
";
$result = mysqli_query($conn, $query);

// Check if the student data was retrieved
if (mysqli_num_rows($result) == 1) {
    $student = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching student information";
    exit();
}

// Logout functionality
if (isset($_GET['Back'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container">
        <h1>Student Profile</h1>
        <div class="profile-details">
            <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['StudentID']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($student['FirstName']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($student['LastName']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['Email']); ?></p>
            <p><strong>Birthday:</strong> <?php echo htmlspecialchars($student['Birthday']); ?></p>
            <p><strong>Major:</strong> <?php echo htmlspecialchars($student['MajorName']); ?></p>
            <p><strong>Department:</strong> <?php echo htmlspecialchars($student['DepartmentName']); ?></p>
        </div>
        <a href="index.php" class="button">Back</a>
    </div>
</body>
</html>
