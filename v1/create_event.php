<?php

session_start();

include 'dbconnect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $date_time = $_POST['date_time'];
    $organizer = $_POST['organizer'];
    $purpose = $_POST['purpose'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // HANDLE FILE UPLOAD
    $photoName = time() . "_" . basename($_FILES['photo']['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $photoName;

    // CREATE uploads FOLDER IF NEEDED
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // MOVE FILE
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {

        $sql = "INSERT INTO events
        (name, date_time, organizer, purpose, description, photo, location)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sssssss",
            $name,
            $date_time,
            $organizer,
            $purpose,
            $description,
            $targetFile,
            $location
        );

        if ($stmt->execute()) {

            $message = "Event created successfully";

        } else {

            $message = "Database insertion failed";

        }

    } else {

        $message = "Photo upload failed";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Create a new event</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel ="icon" type="image" href="assets/icon.png">
</head>
<body>
    <div class="app">
        <header>
            <div class="topnav">
                <a href="index.html" class="active"><img class="back" src="assets/icon.png"></a>
                <div id="myLinks">
                    <a href="index.html">Home</a>
                    <a href="login.php" id="authLink">Log in</a>
                    <a href="fund_list.php">Funds</a>
                    <a href="event_list.php">Events</a>
                    <a href="contact.html">Contact us</a>
                </div>
                <a href="javascript:void(0);" class="menu" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </header><br>

        <h2>Create a new event</h2>

        <div class="login-form">
            <form class ="login" method="POST" enctype="multipart/form-data">
                
                <label for="name">Name of the event</label>
                <input type="text" id="name" name="name" required>
                <br><br>

                <label for="end_date">Date and time</label>
                <input type="datetime-local" id="date_time" name="date_time" min="2014-01-01">
                <br><br>

                <label for="organizer">Name of the organizer</label>
                <input type="text" id="organizer" name="organizer" required>
                <br><br>

                <label for="purpose">Purpose of the event</label>
                <input type="text" id="purpose" name="purpose">
                <br><br>

                <label for="description">Description of the event</label>
                <textarea id="description" name="description" placeholder="Tell us more about your event..." required></textarea>
                <br><br>

                <label for="photo">Photo, describing the event</label>
                <input type="file" name="photo" id="photo" required>
                <br><br>

                <label for="location">Location</label>
                <input type="text" id="location" name="location">
                <br><br>

                <button class="message" type="submit">Send the application</button>
            </form>
        </div>

        <?php if (!empty($message)) : ?>

        <h4 class="success-message">
            
            <?php 
            header("Location: event_list.php");
            exit();
            echo $message; ?>
        </h4>

        <?php endif; ?>
        <br>

        <footer>
            <p>U Matter © 2026 All rights reserved</p>
        </footer>
    </div>

<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>
