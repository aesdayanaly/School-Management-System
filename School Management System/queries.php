<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url("https://i.pinimg.com/564x/48/02/9f/48029f7b207aa27d512b20b895236185.jpg");
            background-size: cover;
            font-family: "Poppins", sans-serif;
        }

        .hover-text {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            border-radius: 3px;
            z-index: 10;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-container:hover .hover-text {
            display: block;
        }

        .image-item {
            width: 400px; /* Adjust the width as needed */
            height: auto; /* Maintain the aspect ratio */
        }
        .container {
        max-width: 1200px;
         width: 95%;
        }
        .backBtn {
        background-color: transparent;
        color: black;
        font-size: 1.2rem;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: 0.4s;
        border: 2px solid rgba(255, 255, 255, 0.3);
        position: absolute;
        top: 1rem; /* Adjust as needed */
        left: 1rem; /* Adjust as needed */
    }

        h2 {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            margin: 0;
            padding: 1rem; /* Adjust as needed */
        }

    </style>
</head>
<body>
      <button class="backBtn">
        <a href="index.php" class="uil-arrow-left" style="color: inherit; text-decoration: none;">&#x2190;</a>
    </button>
          <h2>Query</h2>
        <ul class="container">
        <a href="query.php" class="image-container">
        <img class="image-item" src="https://static.vecteezy.com/system/resources/previews/021/720/933/original/character-student-back-to-school-university-concept-png.png" alt="img-1" />
        <span class="hover-text">student - major</span>
    </a>
    <a href="qr1.php" class="image-container">
        <img class="image-item" src="https://static.vecteezy.com/system/resources/previews/027/124/891/non_2x/school-building-7-3d-illustration-free-png.png" alt="img-1" />
        <span class="hover-text"> Major - Department</span>
        </ul>
    </a>
</body>
</html>
