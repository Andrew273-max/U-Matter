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
<body>
    <div class="second-app">
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
        </header>
        <section class="fund-event-info">
            <div class="top-section-info">
                <div class="hero-text">
                    <h3><?php echo $event['name']; ?></h3>
                    <h5><?php echo date("d F H:i", strtotime($event['date_time'])); ?></h5>
                </div>
                <img 
                    src="<?php echo $event['photo']; ?>" 
                    alt="<?php echo $event['name']; ?>"
                    class="hero-image">

                <div class="overlay-hero"></div>
            </div>
            <div class="middle-left-info">
                <h5>Are you one of the organizers?</h5>
                <div class="btn"><a href="login.php">Log in</a></div>
                
                <h3>Purpose of the event</h3>
                <p><?php echo $event['purpose']; ?></p>

                <h3>Organizer</h3>
                <p><?php echo $event['organizer']; ?></p>
            </div>
            <div class="middle-right-info">
                <h3>Activities at<br>the event</h3>
                <p><?php echo $event['description']; ?></p><br>
            </div>
        </section>
        <footer>
            <p>U Matter © 2026 All rights reserved</p>
        </footer>
    </div>

<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>
