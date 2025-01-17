<?php
require 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if the student's name is set in the session
$student_name = isset($_SESSION['student_name']) ? $_SESSION['student_name'] : 'Guest';

// Sample attendance data for the entire month of June 2024 excluding weekends
$attendance = [];
for ($day = 1; $day <= 30; $day++) {
    $month = date('F', mktime(0, 0, 0, 6, 1));
    $date = sprintf('%s %02d', $month, $day);
    $dayOfWeek = date('N', strtotime($date)); // 1 (for Monday) through 7 (for Sunday)
    if ($dayOfWeek >= 6) {
        continue; // Skip Saturday (6) and Sunday (7)
    }
    $status = rand(0, 1) ? 'Present' : 'Absent'; // Randomly assign Present or Absent
    $attendance[] = ['date' => $date, 'status' => $status];
}

$days_attended = 0;
$days_missed = 0;

foreach ($attendance as $record) {
    if ($record['status'] === 'Present') {
        $days_attended++;
    } else {
        $days_missed++;
    }
}

$dates = array_column($attendance, 'date');
$statuses = array_column($attendance, 'status');

// Sample course and professor data
$courses = [
    ['name' => 'Course 1', 'professor' => 'Professor A'],
    ['name' => 'Course 2', 'professor' => 'Professor B'],
    ['name' => 'Course 3', 'professor' => 'Professor C'],
    // Add more courses and professors as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<nav class="sidebar">
    <h1>Course</h1>
    <br>
    <ul class="sidebar_menu">
        <li class="sidebar_item">
            <a href="index.php" class="sidebar_link"> Dashboard </a>
        </li>
    </ul>
    <ul class="sidebar_menu">
        <li class="sidebar_item">
            <a href="index-course.php" class="sidebar_link"> Course </a>
        </li>
    </ul>
    <br><br>
    <ul class="sidebar_menu">
        <li class="sidebar_item">
            <a href="inbox.php" class="sidebar_link"> Inbox </a>
        </li>
    </ul>
    <div class="sidebar_info">
        <img class="sidebara-img" src="assets/website.png" alt="web">
        <p>www.tup.edu.ph</p>
    </div>
    <div class="sidebar_info">
        <img class="sidebara-img" src="assets/phone.png" alt="phone">
        <p>+632-5301-3001</p>
    </div>
    <div class="sidebar_info">
        <img class="sidebara-img" src="assets/mail.png" alt="mail">
        <p>tup@tup.edu.ph</p>
    </div>
</nav>
<div class="header">
    <div>
        <img src="assets/dashboard.png" alt="Dashboard" class="dashboard-img">
    </div>
    <div>
        <h1>Course</h1>
    </div>
    <div class="profile-container">
        <img src="assets/profile.png" alt="Profile" class="profile-img">
        <div class="about-box2">
            <a href="profile.php">Profile</a>
            <a href="dashboard.php">Logout</a>
        </div>
    </div>
</div>

<div class="dashboard-container">
    <div class="attendance-section1">
        <div class="card1">
            <h2>Activities to Pass</h2>
            <table>
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $activities = [
                        'Essay for Literature',
                        'Exam in Automata',
                        'Coding in Python',
                        'Project Presentation',
                        'Lab Report in Chemistry',
                        'Research Paper in History'
                    ];

                    foreach ($activities as $activity) {
                        $deadline_day = rand(1, 30);
                        $deadline_date = date('F j', mktime(0, 0, 0, 6, $deadline_day));

                        echo "<tr>";
                        echo "<td>{$activity}</td>";
                        echo "<td>{$deadline_date}</td>";
                        echo "<td>";
                        echo "<select name='activity_{$activity}'>";
                        echo "<option value='ongoing'>Ongoing</option>";
                        echo "<option value='done'>Done</option>";
                        echo "<option value='not_started'>Didn't Start</option>";
                        echo "</select>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="card2">
            <div class="card-header">
                <h2>Courses and Professors</h2>
            </div>
            <div class="card-body">
                <?php foreach ($courses as $course): ?>
                    <div class="course">
                        <h3><?php echo htmlspecialchars($course['name']); ?></h3>
                        <p>Professor: <?php echo htmlspecialchars($course['professor']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default behavior of the link

    // Display a confirmation dialog
    if (confirm('Are you sure you want to logout?')) {
        // If the user clicks "OK", proceed with logout
        window.location.href = 'logout.php'; // Replace 'logout.php' with the actual logout script
    } else {
        // If the user clicks "Cancel", do nothing
        return false;
    }
});
</script>

</body>
</html>
