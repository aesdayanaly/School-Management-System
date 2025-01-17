<?php
require 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if the student's name is set in the session
$student_name = isset($_SESSION['student_name']) ? $_SESSION['student_name'] : 'Guest';

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
<nav class="sidebar">
    <h1>Inbox</h1>
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
    <h1>Inbox</h1>
    </div>
    <div class="profile-container">
        <img src="assets/profile.png" alt="Profile" class="profile-img">
        <div class="about-box2">
            <a href="profile.php">Profile</a>
            <a href="dashboard.php">Logout</a>
        </div>
    </div>
</div>

<div class="dashboard">
    <div class="chat-container">
        <div class="chat-header">
            <h2>Student Chat</h2>
        </div>
        <div class="teacher-list">
            <div class="teacher">
                <img src="https://static.vecteezy.com/system/resources/previews/023/254/079/non_2x/smiling-male-teacher-character-pointing-free-png.png" alt="Teacher 1">
                <span>Mr. Smith</span>
            </div>
            <div class="teacher">
                <img src=https://png.pngtree.com/png-vector/20230430/ourmid/pngtree-teachers-day-characters-png-image_6740168.png alt="Teacher 2">
                <span>Ms. Jones</span>
            </div>
            <div class="teacher">
                <img src="https://www.pikpng.com/pngl/b/53-531075_teacher-png-instructor-clipart-transparent-png.png" alt="Teacher 3">
                <span>Ms. Mikha</span>
            </div>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Messages will be displayed here -->
        </div>
        <div class="chat-input">
            <textarea id="chat-input" placeholder="Type your message..."></textarea>
            <button id="send-button">Send</button>
        </div>
    </div>
</div>
<script>
// Define variables for chat elements
const chatMessages = document.getElementById('chat-messages');
const chatInput = document.getElementById('chat-input');
const sendButton = document.getElementById('send-button');
const teacherSelect = document.getElementById('teacher-select');

// Function to add a message to the chat
function addMessage(message, sender) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.textContent = `${sender}: ${message}`;
    chatMessages.appendChild(messageElement);
    // Scroll to the bottom of the chat
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Event listener for send button
sendButton.addEventListener('click', () => {
    const message = chatInput.value.trim();
    if (message !== '') {
        const selectedTeacher = teacherSelect.options[teacherSelect.selectedIndex].text;
        addMessage(message, `You to ${selectedTeacher}`);
        // Here, you would send the message to the server or another client
        chatInput.value = '';
    }
});

// Example: Receive message from the teacher
// Replace this with your actual implementation to receive messages
function receiveMessage(message, sender) {
    addMessage(message, `Teacher ${sender}`);
}

// Example: Receive message from the teacher after 2 seconds
setTimeout(() => {
    receiveMessage('Hello! How can I help you?', 1);
}, 2000);

// Example: Receive message from the teacher after 5 seconds
setTimeout(() => {
    receiveMessage('Are you following along?', 2);
}, 5000);

// Example: Receive message from the teacher after 8 seconds
setTimeout(() => {
    receiveMessage('Let me know if you have any questions.', 3);
}, 8000);
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
