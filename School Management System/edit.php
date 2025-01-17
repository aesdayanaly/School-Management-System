<?php
include "connection.php";

if (isset($_GET['id'])) {
    $courseID = $_GET['id'];

    // Fetch course data based on the provided CourseID
    $query = "SELECT * FROM course WHERE CourseID = '$courseID'";
    $result = mysqli_query($conn, $query);
    $course = mysqli_fetch_assoc($result);

    if (!$course) {
        echo "Course not found";
        exit;
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $courseName = $_POST['courseName'];
        $credits = $_POST['credits'];

        // Update the course data in the database
        $updateQuery = "UPDATE course SET CourseName = '$courseName', Credits = '$credits' WHERE CourseID = '$courseID'";
        if (mysqli_query($conn, $updateQuery)) {
            header("Location: read.php"); // Redirect to the course list page
            exit;
        } else {
            echo "Error updating course: " . mysqli_error($conn);
        }
    }
} else {
    echo "Course ID not provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit Course</title>
</head>
<button style="background-color: transparent; color: black; font-size: 1.2rem; font-weight: 500; letter-spacing: 1px; margin-top: 1.7rem; cursor: pointer; transition: 0.4s; border: 2px solid rgba(0, 0, 0, 0.3); margin-left: 1rem;">
    <a href="read.php" class="uil-arrow-left" style="color: inherit; text-decoration: none;">&#x2190;</a>
</button>
<body>

    <div class="container">
        <div class="text-center mb-4">
        <h1 style="font-weight: 700; text-align: center;">Edit Course Information</h1>
        </div>

        <form method="post">
        <div style="font-weight: 600; font-size:20px;" class="mb-3">
                <label for="courseName" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="courseName" name="courseName" value="<?php echo htmlspecialchars($course['CourseName']); ?>" required>
            </div>
             <div style="font-weight: 600; font-size:20px;" class="mb-3">
                <label for="credits" class="form-label">Credits</label>
                <input type="number" class="form-control" id="credits" name="credits" value="<?php echo htmlspecialchars($course['Credits']); ?>" required>
            </div>
            <button type="submit" style="background-color: #d49cbc; border: none; font-size: 17px; border-radius: 10%; color: black; border: 2px solid black; padding: 7px;" >Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
