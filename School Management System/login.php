<?php
// Include your database connection file
include "connection.php";

// Start session
session_start();

// Initialize login status variable
$login_status = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access form data safely
    $email = isset($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
    $password = isset($_POST['Password']) ? mysqli_real_escape_string($conn, $_POST['Password']) : '';
    $studentId = isset($_POST['StudentID']) ? mysqli_real_escape_string($conn, $_POST['StudentID']) : '';

    // Admin login check
    if ($email == 'admin@a.com' && $password == 'admin' && $studentID == 'admin') {
        header("Location: admin-index.php"); // Redirect to admin page
        exit; // Make sure to stop execution after redirection
    }

    // Use form data in your queries or other logic
    // For example, you might use these values in a SQL query to check if the student exists in your database
    $sql = "SELECT * FROM student WHERE Email='$email' AND Password='$password' AND StudentID='$studentId'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if a row is returned
    if ($result && mysqli_num_rows($result) > 0) {
        // Student exists, redirect to index.php
        $row = mysqli_fetch_assoc($result);
        $_SESSION['StudentID'] = $row['StudentID'];
        $_SESSION['StudentName'] = $row['FirstName']; // Store student's first name in session
        header("Location: index.php");
        exit; // Make sure to stop execution after redirection
    } else {
        // Student does not exist, set the login status message
        $login_status = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css" />
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="box">
        <h2>Login Form</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Email:</label>
            <input type="email" name="Email" required><br><br>

            <label>Password:</label>
            <input type="password" name="Password" required><br><br>

            <label>Student ID:</label>
            <input type="text" name="StudentID" required><br><br>

            <button type="submit">Submit</button>
        </form>
        <?php if ($login_status != ""): ?>
            <p><?php echo $login_status; ?></p>
        <?php endif; ?>
    </div>

    <div class="separator">
        <hr>
    </div>

    <div class="box">
    <img src="https://cdni.iconscout.com/illustration/premium/thumb/school-building-6464827-5349409.png?f=webp" alt="heroImg" class="hero_img" />
    </div>
</div>
</body>
</html>
