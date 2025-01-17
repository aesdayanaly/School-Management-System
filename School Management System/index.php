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
<div>
<nav class="sidebar">
    <h1>Dashboard</h1>
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
    <h1>Dashboard</h1>
    </div>
    <div class="profile-container">
        <img src="assets/profile.png" alt="Profile" class="profile-img">
        <div class="about-box2">
            <a href="profile.php">Profile</a>
            <a href="dashboard.php">Logout</a>
        </div>
    </div>
</div>

    <div class="cards-container">
        <div class="card1">
            <div class="cards-body">
                <div class="student-info">
                    <div id="clock" class="clock"></div>
                    <p>Welcome, <?php echo htmlspecialchars($student_name); ?>!</p>
                    <img src="https://media.istockphoto.com/id/1326969659/vector/young-woman-jane-sitting-at-desk-in-front-laptop-holding-pencil-doing-assignment-thinking.jpg?s=612x612&w=0&k=20&c=hileFFPPB9rguaE7NplFCA73okpZvnHYlyQn9qXaJ9E=" class="student-img">
                </div>
            </div>
        </div>
    </div>
</div>




<div class="main-content">
    <div class="calendar-attendance-container">
        <div class="calendar-container">
            <h2>Calendar</h2>
            <div class="events-section">
                <h3>Upcoming Events</h3>
                <ul id="events-list">
                    <li><strong>June 10:</strong> Math Exam</li>
                    <li><strong>June 12:</strong> School Holiday</li>
                    <li><strong>June 15:</strong> Science Fair</li>
                    <li><strong>June 20:</strong> Art Exhibition</li>
                    <li><strong>June 25:</strong> Sports Day</li>
                </ul>
            </div>
            <div id="calendar" class="calendar-section"></div>
        </div>
        <div class="info-sections-container">
            <div class="attendance-section">
                <h2>Attendance Record</h2>
                <p>Days Attended: <?php echo $days_attended; ?></p>
                <p>Days Missed: <?php echo $days_missed; ?></p>
                <canvas id="attendanceChart"></canvas>
            </div>
            <div class="notice-birthday-container">
                <div class="notice-section">
                    <div class="card">
                        <div class="card-header">
                            <h2>Notice Board</h2>
                        </div>
                        <div class="card-body">
                            <div class="notice">
                                <p><strong>From Prof. Smith:</strong> The deadline for the research paper has been extended to June 30.</p>
                            </div>
                            <div class="notice">
                                <p><strong>From Director Johnson:</strong> Reminder about the upcoming holiday on June 12.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="birthday-section">
                    <div class="card1">
                        <div class="card-header">
                            <h2>Birthday Corner</h2>
                        </div>
                        <div class="card-body">
                            <div class="birthday">
                                <p><strong>Happy Birthday, Jane Doe!</strong></p>
                            </div>
                            <div class="birthday">
                                <p><strong>Happy Birthday, John Smith!</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            {
                title: 'Flag Ceremony',
                start: '2024-06-03'
            },
            {
                title: 'Final Examination',
                start: '2024-06-13',
                end: '2024-06-16'
            },
            {
                title: 'Flag Ceremony',
                start: '2024-06-10'
            },
            {
                title: 'Flag Ceremony',
                start: '2024-06-17'
            }
        ]
    });
    calendar.render();

    // Attendance chart
    var ctx = document.getElementById('attendanceChart').getContext('2d');
    var attendanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Attendance',
                data: <?php echo json_encode(array_map(function($status) {
                    return $status == 'Present' ? 1 : 0;
                }, $statuses)); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value ? 'Present' : 'Absent';
                        },
                        stepSize: 1,
                        max: 1
                    }
                }
            }
        }
    });
    function updateClock() {
    var now = new Date();
    var day = now.getDate().toString().padStart(2, '0');
    var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
    var year = now.getFullYear();
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    var seconds = now.getSeconds().toString().padStart(2, '0');
    var dateString = month + '/' + day + '/' + year;
    var timeString = hours + ':' + minutes + ':' + seconds;

    document.getElementById('clock').innerText = dateString + ' ' + timeString;
}

// Update the clock every second
setInterval(updateClock, 1000);

// Initialize the clock immediately
updateClock();
});
</script>
</body>
</html>
