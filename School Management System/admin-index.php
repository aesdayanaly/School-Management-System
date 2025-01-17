<?php
require 'connection.php';
session_start();

// Check if the student is logged in

// Simulated data for student count, teacher count, school performance, and departments
$result = $conn->query("SELECT 
                            (SELECT COUNT(*) FROM student) AS studentsCount, 
                            (SELECT COUNT(*) FROM department) AS departmentsCount, 
                            (SELECT COUNT(*) FROM major) AS majorsCount,
                            'Excellent' AS school_performance,
                            '50' AS professorsCount")->fetch_assoc(); // Combining queries into one

$studentsCount = $result['studentsCount'];
$departmentsCount = $result['departmentsCount'];
$majorsCount = $result['majorsCount'];
$school_performance = $result['school_performance'];
$professorsCount = $result['professorsCount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PROJECT</title>
  <link rel="stylesheet" href="admin.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <main>
    <!-- Header Start -->
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
    <!-- Header End -->

    <!-- Sidebar Start -->
    <nav class="sidebar">
      <h2 class="sidebar_logo">Welcome, Admin</h2>
      <ul class="sidebar_menu">
        <li><a href="stud-read.php" class="sidebar_link">Student</a></li>
        <li><a href="major-read.php" class="sidebar_link">Major</a></li>
        <li><a href="read.php" class="sidebar_link">Course</a></li>
        <li><a href="depar-read.php" class="sidebar_link">Department</a></li>
        <li><a href="query.php" class="sidebar_link">Student Information</a></li> 
        <li><a href="qr1.php" class="sidebar_link">Major Information</a></li> 
      </ul>
    </nav>
    <!-- Sidebar End -->

    <!-- Container 1 Start -->
    <div class="container1">
        <div class="card">
            <img src="assets/students.png" alt="Students" class="card-img">
            <h2><?php echo $studentsCount; ?></h2>
            <p>Students enrolled</p>
        </div>
        <div class="card" id="departmentsCard">
            <img src="assets/department.png" alt="Departments" class="card-img">
            <h2><?php echo $departmentsCount; ?></h2>
            <p>Departments</p>
        </div>
        <div class="card">
            <img src="assets/major.png" alt="Majors" class="card-img">
            <h2><?php echo $majorsCount; ?></h2>
            <p>Professors</p>
        </div>
        <div class="card">
            <img src="assets/course.png" alt="Courses" class="card-img">
            <h2><?php echo $school_performance; ?></h2>
            <p>School Performance</p>
        </div>
    </div>
    <!-- Container 1 End -->

    <!-- Container 2 Start -->
    <div class="info-sections-container">
        <!-- Chart and Notice Board -->
        <div class="notice-schoolchart">
            <div class="notice-birthday-container">
                <!-- Notice Board -->
                <div class="card1">
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
                         <div class="notice">
                            <p><strong>From Director Johnson:</strong> Reminder about the upcoming holiday on June 12.</p>
                        </div>                        
                        <div class="notice">
                            <p><strong>From Director Johnson:</strong> Reminder about the upcoming holiday on June 12.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="card1">
                <canvas id="schoolStatisticsChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Container 2 End -->
  </main>

  <!-- Custom Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Simulated data for the line chart
      const years = ['2020', '2021', '2022', '2023', '2024'];
      const studentCounts = [50, 25, 100, 100, 100];
      const departmentCounts = [1, 10, 4, 6, 6];
      const teacherCounts = [40, 45, 50, 55, 60];
      const schoolPerformance = ['Excellent', 'Good', 'Excellent', 'Bad', 'Excellent'];

      // Convert categorical data to numerical values
      const performanceValues = schoolPerformance.map(performance => {
        switch (performance) {
          case 'Excellent':
            return 100;
          case 'Good':
            return 80;
          case 'Average':
            return 60;
          case 'Bad':
            return 40;
          case 'Very Bad':
            return 20;
          default:
            return 0;
        }
      });

      // Get the canvas element
      const ctx = document.getElementById('schoolStatisticsChart').getContext('2d');

      // Create the line chart
      const schoolStatisticsChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: years,
          datasets: [{
              label: 'Student Count',
              data: studentCounts,
              borderColor: '#CDE8E5',
              fill: false
            },
            {
              label: 'Department Count',
              data: departmentCounts,
              borderColor: '#7AB2B2',
              fill: false
            },
            {
              label: 'Teacher Count',
              data: teacherCounts,
              borderColor: '#4D869C',
              fill: false
            },
            {
              label: 'School Performance',
              data: performanceValues,
              borderColor: '#4D869C',
              fill: false
            }
          ]
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'School Statistics'
          },
          scales: {
            xAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Year'
              }
            }],
            yAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Count / Performance'
              },
              ticks: {
                beginAtZero: true,
                stepSize: 20,
                max: 120,
                callback: function(value, index, values) {
                  // Convert numerical values back to categorical labels
                  switch (value) {
                    case 20:
                      return 'Very Bad';
                    case 40:
                      return 'Bad';
                    case 60:
                      return 'Average';
                    case 80:
                      return 'Good';
                    case 100:
                      return 'Excellent';
                    default:
                      return '';
                  }
                }
              }
            }]
          }
        }
      });
    });
  </script>
</body>
</html>
