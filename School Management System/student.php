<?php
include 'connection.php';

if (isset($_POST["submit"])) {
    $StudentID = trim($_POST["StudentID"]);
    $FirstName = trim($_POST["FirstName"]);
    $LastName = trim($_POST["LastName"]);
    $Email = trim($_POST["Email"]);
    $Gender = trim($_POST["Gender"]);
    $Password = trim($_POST["Password"]);
    $Birthday = trim($_POST["Birthday"]);
    $MajorID = trim($_POST["MajorID"]);

    // Validate inputs
    $errors = [];
    if (empty($StudentID) || !preg_match('/^[A-Za-z0-9-]+$/', $StudentID)) {
        $errors[] = "Invalid Student ID.";
    }    
    if (empty($FirstName) || !preg_match('/^[A-Za-z]+$/', $FirstName)) {
        $errors[] = "Invalid First Name.";
    }
    if (empty($LastName) || !preg_match('/^[A-Za-z]+$/', $LastName)) {
        $errors[] = "Invalid Last Name.";
    }
    if (empty($Email) || !filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email.";
    }
    if (empty($Gender) || !in_array($Gender, ['Male', 'Female', 'Other'])) {
        $errors[] = "Invalid Gender.";
    }
    if (empty($Password) || strlen($Password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    if (empty($Birthday) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $Birthday)) {
        $errors[] = "Invalid Birthday format. Use YYYY-MM-DD.";
    }
    if (empty($MajorID) || !preg_match('/^[0-9]+$/', $MajorID)) {
        $errors[] = "Invalid Major ID.";
    }

    // Check for duplicates
    if (empty($errors)) {
        $query = "SELECT * FROM student WHERE Email = '$Email' OR (FirstName = '$FirstName' AND LastName = '$LastName')";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('A student with the same email or the same details already exists. Possible duplicate entry.');</script>";
        } else {
            $query = "INSERT INTO student (StudentID, FirstName, LastName, Email, Gender, Password, Birthday, MajorID) VALUES ('$StudentID', '$FirstName', '$LastName', '$Email', '$Gender', '$Password', '$Birthday', '$MajorID')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Data Inserted Successfully');</script>";
            } else {
                echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "');</script>";
            }
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
    <title>Student</title>
</head>
<body>
    <button type="back" name="back" class="backBtn">
        <a href="stud-read.php" class=" uil-arrow-left"></a>
    </button>
    <div class="container">
        <form action="#" method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Student Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Student ID</label>
                            <input type="text" name="StudentID" placeholder="Enter the student ID" required>
                        </div>
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" name="FirstName" placeholder="Enter the first name" required>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" name="LastName" placeholder="Enter the last name" required>
                        </div>
                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" name="Email" placeholder="Enter the email" required>
                        </div>
                        <div class="input-field">
                            <label>Gender</label>
                            <select name="Gender" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" name="Password" placeholder="Enter the password" required>
                        </div>
                        <div class="input-field">
                            <label>Birthday</label>
                            <input type="date" name="Birthday" placeholder="Enter the birthday" required>
                        </div>
                        <div class="input-field">
                            <label>Major ID</label>
                            <input type="text" name="MajorID" placeholder="Enter the major ID" required>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" name="submit">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
