<?php
include 'connection.php';

if (isset($_GET["id"])) {
    $StudentID = $_GET["id"];

    // Fetch the existing data for the student
    $query = "SELECT * FROM student WHERE StudentID='$StudentID'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Student not found.");
    }
}

if (isset($_POST["update"])) {
    $StudentID = $_POST["StudentID"];
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
    if (!empty($Password) && strlen($Password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    if (empty($Birthday) || !preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $Birthday)) {
        $errors[] = "Invalid Birthday format. Use DD/MM/YYYY.";
    }
    
    if (empty($MajorID) || !preg_match('/^[0-9]+$/', $MajorID)) {
        $errors[] = "Invalid Major ID.";
    }

    // If no errors, proceed with database update
    if (empty($errors)) {
        // Hash the password if it is provided
        $hashedPassword = !empty($Password) ? ", Password='" . password_hash($Password, PASSWORD_DEFAULT) . "'" : "";

        $query = "UPDATE student SET FirstName='$FirstName', LastName='$LastName', Email='$Email', Gender='$Gender', Birthday='$Birthday', MajorID='$MajorID' $hashedPassword WHERE StudentID='$StudentID'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data Updated Successfully');</script>";
        } else {
            echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
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
    <title>Edit Student</title>
</head>
<body>
    <button type="back" name="back" class="backBtn">
        <a href="stud-read.php" class=" uil-arrow-left"></a>
    </button>
    <div class="container">
        <form action="#" method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Edit Student Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Student ID</label>
                            <input type="text" name="StudentID" value="<?php echo htmlspecialchars($row['StudentID']); ?>" readonly>
                        </div>
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" name="FirstName" value="<?php echo htmlspecialchars($row['FirstName']); ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" name="LastName" value="<?php echo htmlspecialchars($row['LastName']); ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" name="Email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Gender</label>
                            <select name="Gender" required>
                                <option value="Male" <?php if ($row['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($row['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                <option value="Other" <?php if ($row['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Password (Leave blank if not changing)</label>
                            <input type="password" name="Password" placeholder="Enter the password">
                        </div>
                        <div class="input-field">
                            <label>Birthday</label>
                            <input type="text" name="Birthday" value="<?php echo htmlspecialchars($row['Birthday']); ?>" required>
                        </div>
                        <div class="input-field">
                            <label>Major ID</label>
                            <input type="text" name="MajorID" value="<?php echo htmlspecialchars($row['MajorID']); ?>" required>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" name="update">
                        <span class="btnText">Update</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
