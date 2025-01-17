<?php
// Include the database connection file
include 'connection.php';

// Write your SQL query to join student and major tables
$sql = "SELECT student.StudentID, student.FirstName, student.LastName, major.MajorID, major.MajorName
        FROM student
        INNER JOIN major ON student.MajorID = major.MajorID";

// Execute the query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Query (Student - Major) </title>
    <style>
        button {
            background-color: transparent;
            color: black;
            font-size: 1.2rem;
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: 1.7rem;
            cursor: pointer;
            transition: 0.4s;
            border: 2px solid rgba(0, 0, 0, 0.3);
            margin-left: 1rem;
        }
        .btn {
            background-color: black;
            color: white;
            margin-bottom: 1.5rem;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <button>
        <a href="admin-index.php" class="uil-arrow-left" style="color: inherit; text-decoration: none;">&#x2190;</a>
    </button>

    <div class="container">
        <div>
        <h1 style="font-weight: 1000; text-align: center;">Student Infromation</h1>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>StudentID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Major Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['StudentID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['MajorName']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
