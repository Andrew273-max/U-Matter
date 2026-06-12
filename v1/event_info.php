<?php

include 'dbconnect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM umatterdb.events WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$event = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Event info</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel ="icon" type="image" href="assets/icon.png">
</head>
<body class="info">
    <header>
        <div class="topnav">
            <a href="index.html" class="active"><img class="back" src="assets/icon.png"></a>
            <div id="myLinks">
                <a href="login.php id="authLink"">Log in</a>
                <a href="fund_list.php">Funds</a>
                <a href="event_list.php">Events</a>
                <a href="contact.html">Contact us</a>
            </div>
            <a href="javascript:void(0);" class="menu" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <div class="details-container">
        <div class="top-section">
            <div class="fund-event-info">
                <h1><?php echo $event['name']; ?></h1><br>

                <h2>Purpose of the event</h2>
                <p><?php echo $event['purpose']; ?></p>

                <h2>Organizer</h2>
                <p><?php echo $event['organizer']; ?></p>

                <h2>Date and time</h2>
                <p><?php echo $event['date_time']; ?></p>
            </div>
            <div class="event-image"></div>
        </div>
        <div class="description-section">
            <h2>Activities at the event</h2>
            <p><?php echo $event['description']; ?></p>
        </div>
    </div>
    <footer>
        <p>U Matter © 2026 All rights reserved</p>
    </footer>
<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>