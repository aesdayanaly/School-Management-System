<?php
include "connection.php";

if (isset($_GET['id'])) {
    $MajorID = $_GET['id'];

    // Fetch major data based on the provided MajorID
    $query = "SELECT * FROM major WHERE MajorID = '$MajorID'";
    $result = mysqli_query($conn, $query);
    $major = mysqli_fetch_assoc($result);

    if (!$major) {
        echo "Major not found";
        exit;
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $MajorName = $_POST['MajorName'];
        $DepartmentID = $_POST['DepartmentID'];

        // Update the Major data in the database
        $updateQuery = "UPDATE major SET MajorName = '$MajorName', DepartmentID = '$DepartmentID' WHERE MajorID = '$MajorID'";
        if (mysqli_query($conn, $updateQuery)) {
            header("Location: major-read.php"); // Redirect to the Major list page
            exit;
        } else {
            echo "Error updating major: " . mysqli_error($conn);
        }
    }
} else {
    echo "Major ID not provided";
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
    <title>Edit Major</title>
</head>
<button style="background-color: transparent; color: black; font-size: 1.2rem; font-weight: 500; letter-spacing: 1px; margin-top: 1.7rem; cursor: pointer; transition: 0.4s; border: 2px solid rgba(0, 0, 0, 0.3); margin-left: 1rem;">
    <a href="major-read.php" class="uil-arrow-left" style="color: inherit; text-decoration: none;">&#x2190;</a>
</button>
<body style="background-image: url('https://i.pinimg.com/564x/48/02/9f/48029f7b207aa27d512b20b895236185.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Major Details</h3>
        </div>

        <form method="post">
            <div class="mb-3">
                <label for="MajorName" class="form-label">Major Name</label>
                <input type="text" class="form-control" id="MajorName" name="MajorName" value="<?php echo htmlspecialchars($major['MajorName']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="DepartmentID" class="form-label">Department ID</label>
                <input type="number" class="form-control" id="DepartmentID" name="DepartmentID" value="<?php echo htmlspecialchars($major['DepartmentID']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
