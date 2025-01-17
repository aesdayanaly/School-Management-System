<?php
include "connection.php";

// Fetch all data from the `department` table
$query = "SELECT * FROM department";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Department List</title>
</head>
<body>
<button style="background-color: transparent; color: black; font-size: 1.2rem; font-weight: 500; letter-spacing: 1px; margin-top: 1.7rem; cursor: pointer; transition: 0.4s; border: 2px solid rgba(0, 0, 0, 0.3); margin-left: 1rem;">
    <a href="admin-index.php" class="uil-arrow-left" style="color: inherit; text-decoration: none;">&#x2190;</a>
</button>

<div class="container">
    <div>
        <h1 style="font-weight: 1000; text-align: center;">Department List</h1>
    </div>
    <a href="department.php" style=" padding: 14px 26px; color:black; text-decoration: none; background: transparent; border-radius: 50px; border: 2px solid black; cursor: pointer; transition: all 0.3s ease; margin-bottom: 1.2rem;">Insert New Details</a>

    <table style="margin-top: 2%" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['DepartmentID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['DepartmentName']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
                echo "<td>";
                echo "<a href='depar-edit.php?id=" . htmlspecialchars($row['DepartmentID']) . "' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>";
                echo "<a href='depar-del.php?id=" . htmlspecialchars($row['DepartmentID']) . "' class='link-dark' onClick=\"return confirm('Are you sure you want to delete this department?');\"><i class='fa-solid fa-trash fs-5'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
