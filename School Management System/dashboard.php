<?php
require 'connection.php';

$studentsCount = $conn->query("SELECT COUNT(*) AS count FROM student")->fetch_assoc()['count'];
$departmentsCount = $conn->query("SELECT COUNT(*) AS count FROM department")->fetch_assoc()['count'];
$majorsCount = $conn->query("SELECT COUNT(*) AS count FROM major")->fetch_assoc()['count'];
$coursesCount = $conn->query("SELECT COUNT(*) AS count FROM course")->fetch_assoc()['count'];

// Fetch department names
$departmentsResult = $conn->query("SELECT DepartmentID, DepartmentName FROM department");
$departments = [];
if ($departmentsResult->num_rows > 0) {
    while ($row = $departmentsResult->fetch_assoc()) {
        $departments[] = $row;
    }
}

// Fetch gender distribution
$maleCount = $conn->query("SELECT COUNT(*) AS count FROM student WHERE gender='Male'")->fetch_assoc()['count'];
$femaleCount = $conn->query("SELECT COUNT(*) AS count FROM student WHERE gender='Female'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<nav class="sidebar">
    <h1>ABOUT TUP</h1>
    <br>
    <ul class="sidebar_menu">
        <li class="sidebar_item">
            <a class="sidebar_link"> Vission and Mission </a>
            <div class="about-box1">
                <h2>VISION</h2>
                <p>TUP: A premier state university with recognized excellence in engineering and technology education at par with leading universities in the ASEAN region.</p>
                <h2>MISSION</h2>
                <p>The mission of TUP is stated in Section 2 of P.D. No. 1518 as follows:</p>
                <p>The University shall provide higher and advanced vocational, technical, industrial, technological and professional education and training in industries and technology, and in practical arts leading to certificates, diplomas and degrees. It shall provide progressive leadership in applied research, developmental studies in technical, industrial, and technological fields and production using indigenous materials; effect technology transfer in the countryside; and assist in the development of small-and-medium scale industries in identified growth centers.</p>
             </ul>
        </div>
    </li>
    <ul class="sidebar_menu">
        <li class="sidebar_item">
            <a class="sidebar_link"> Core Values </a>
            <div class="about-box">
            <h2>CORE VALUES</h2>
            <ul>
                <li>T-Transparent and participatory governance</li>
                <li>U-Unity in the pursuit of TUP mission, goals, and objectives</li>
                <li>P - Professionalism in the discharge of quality service</li>
                <li>I- Integrity and commitment to maintain the good name of the University</li>
                <li>A - Accountability for individual and organizational quality performance</li>
                <li>N - Nationalism through tangible contribution to the rapid economic growth of the country</li>
                <li>S- Shared responsibility, hard work, and resourcefulness in compliance to the mandates of the university</li>
            </ul>
        </div>
    </li>
    <br>
    <br>

    <ul class="sidebar_menu">
        <li class="sidebar_item">
            <a class="sidebar_link"> HYMN </a>
            <div class="about-box2">
                <h2>TUP HYMN</h2>
                <p>MUSIC BY PROF. ROMEO P. VERAYO, SR.</p>
                    <p>by Prof. Emerita R. Verayo</p>
                    <p>Kami sa 'yo'y nagpupugay TUP</p>
                    <p>Ang 'yong tanglaw, liwanag sa aming landas</p>
                    <p>Diwa mo'y ginto, pusong wagas</p>
                    <p>Alay naming sa iyo'y lahat ng hirap</p>
                    <p>Buong pag-ibig at paglilingkod na ganap</p>
                    <p>Kay dami ng anak na 'yong pinagyaman</p>
                    <p>Dahil sa 'yo ngayo'y haligi ng bayan</p>
                    <p>Moog ka ng laya at dangal</p>
                    <p>Teknolohikal na Unibersidad ng Pilipinas</p>
                    <p>Bantayog ka ng lahi naming minamahal.</p>
                    </ul>
            </div>
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
            <a href="login.php">Login</a>
        </div>
    </div>
</div>



    <div class="container">
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
            <p>Majors</p>
        </div>
        <div class="card">
            <img src="assets/course.png" alt="Courses" class="card-img">
            <h2><?php echo $coursesCount; ?></h2>
            <p>Courses</p>
        </div>
    </div>

    <div class="chart-container">
        <canvas id="overviewChart" width="200" height="100"></canvas>
        <canvas id="genderChart" width="200" height="100"></canvas>
    </div>

    <div class="department">
    <h1>College Department</h1>
    <div class="departments-container">
        <div class="card">
            <img src="https://www.tup.edu.ph/assets/images/collegelogo/cos.png" alt="Students" class="card-img">
            <p>College of Science ▼</p>
            <div class="about-box2">
                <h3> College of Science</h3>
                <p>Bachelor of Applied Science in Laboratory Technology</p>
                <p>Bachelor of Science in Computer Science</p>
                <p>Bachelor of Science in Environmental Science</p>
                <p>Bachelor of Science in Information System</p>
                <p>Bachelor of Science in Information Technology</p>
            </div>
        </div>
        <div class="card" id="departmentsCard">
            <img src="https://www.tup.edu.ph/assets/images/collegelogo/cie.png" alt="Departments" class="card-img">
            <p>College of Industrial Education ▼</p>
            <div class="about-box2">
                <h3> College of Industrial Education</h3>
                <p>Bachelor of Science Industrial Education major in Information and Communication Technology</p>
                <p>Bachelor of Science Industrial Education major in Home Economics</p>
                <p>Bachelor of Science Industrial Education major in Industrial Arts</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Animation</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Beauty Care and Wellness</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Computer Programming</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Electrical</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Electronics</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Food Service Management</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Fashion and Garment</p>
                <p>Bachelor of Technical Vocational Teachers Education major in Heat Ventilation & Air Conditioning</p>
                <p>Bachelor of Technical Teacher Education </p>
            </div>
        </div>
        <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8U8sP8gNjExje5V8ampk7_vyCBxz7wMQpXQ&s" alt="Majors" class="card-img">
            <p>College of Industrial Technology ▼</p>
            <div class="about-box2">
                <h3> College of Industrial Technology</h3>
                <p>Bachelor of Science in Food Technology</p>
                <p>Bachelor of Engineering Technology major in Computer Engineering Technology</p>
                <p>Bachelor of Engineering Technology major in Civil Technology</p>
                <p>Bachelor of Engineering Technology major in Electrical Technology</p>
                <p>Bachelor of Engineering Technology major in Electronics Communications Technology</p>
                <p>Bachelor of Engineering Technology major in Electronics Technology</p>
                <p>Bachelor of Engineering Technology major in Instrumentation and Control Technology</p>
                <p>Bachelor of Engineering Technology major in Mechanical Technology</p>
                <p>Bachelor of Engineering Technology major in Mechatronics Technology</p>
                <p>Bachelor of Engineering Technology major in Railway Technology</p>
                <p>Bachelor of Engineering Technology major in Mechanical Engineering Technology option in Automotive Technology</p>
                <p>Bachelor of Engineering Technology major in Mechanical Engineering Technology option in Foundry Technology</p> 
            </div>
        </div>
        <div class="card">
            <img src="https://www.tup.edu.ph/assets/images/collegelogo/coe.png" alt="Courses" class="card-img">
            <p>College of Engineering ▼</p>
            <div class="about-box2">
                <h3> College of Engineering</h3>
                <p>Bachelor of Science in Civil Engineering</p>
                <p>Bachelor of Science in Electrical Engineering</p>
                <p>Bachelor of Science in Industrial Engineering</p>
                <p>Bachelor of Science in Mechanical Engineering</p>
            </div>
        </div>
        <div class="card">
            <img src="https://www.tup.edu.ph/assets/images/collegelogo/cla.png" alt="Courses" class="card-img">
            <p>College of Liberal Arts ▼</p>
            <div class="about-box2">
                <h3> College of Liberal Arts</h3>
                <p>Bachelor of Arts in Management major in Industrial Management</p>
                <p>Bachelor of Science in Entrepreneurship Management</p>
                <p>Bachelor of Science in Hospitality Management</p>
                </div>
        </div>
        <div class="card">
            <img src="https://www.tup.edu.ph/assets/images/collegelogo/cafa.png" alt="Courses" class="card-img">
            <p>College of Fine Arts and Architecture ▼</p>
            <div class="about-box2">
                <h3> College of Fine Arts and Architecture</h3>
                <p> Bachelor of Science in Architecture</p>
                <p>Bachelor of Fine Arts</p>
                <p>Bachelor in Graphics Technology major in Architecture Technology</p>
                <p>Bachelor in Graphics Technology major in Industrial Design</p>
                <p>Bachelor in Graphics Technology major in Mechanical Drafting Technology</p>
               
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    var ctx = document.getElementById('overviewChart').getContext('2d');
    var overviewChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Students', 'Departments', 'Majors', 'Courses'],
            datasets: [{
                label: '',
                data: [
                    <?php echo $studentsCount; ?>,
                    <?php echo $departmentsCount; ?>,
                    <?php echo $majorsCount; ?>,
                    <?php echo $coursesCount; ?>
                ],
                backgroundColor: [
                    'rgb(205, 232, 229)',
                    'rgb(170, 215, 217)',
                    'rgb(122, 178, 178)',
                    'rgb(77, 134, 156)'
                ],
                borderColor: [
                    'rgb(0, 0, 0)',
                    'rgb(0, 0, 0)',
                    'rgb(0, 0, 0)',
                    'rgb(0, 0, 0)'
                ],
                borderWidth: 0.5
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#333'
                    }
                }
            },
            elements: {
                bar: {
                    borderRadius: 4
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    var genderCtx = document.getElementById('genderChart').getContext('2d');
    var genderChart = new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: ['Male 51%', 'Female 49%'],
            datasets: [{
                data: [
                    <?php echo $maleCount; ?>,
                    <?php echo $femaleCount; ?>
                ],
                backgroundColor: [
                    'rgb(205, 232, 229)',
                    '#FFDBE9'
                ],
                borderColor: [
                    'rgb(0, 0, 0)',
                    'rgb(0, 0, 0)'
                ],
                borderWidth: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });


    </script>
</body>
</html>
