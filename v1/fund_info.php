<?php

include 'dbconnect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM umatterdb.funds WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$fund = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Fund info</title>
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
            <div class="text">
                <h3><?php echo $fund['name']; ?></h3>
                <h5>Needed amount: €<?php echo $fund['fund_goal']; ?></h5>
                <h5>Gathering money until <?php echo $fund['end_date']; ?></h5>
            </div>

            <div class="circle">Diagram</div>
        </div>
        <div class="middle-left-info">
            <h5>Are you one of the organizers?</h5>
            <div class="btn"><a href="login.php">Log in</a></div>
            
            <h3>Purpose of the fund</h3>
            <p><?php echo $fund['purpose']; ?></p>

            <h3>Organizer</h3>
            <p><?php echo $fund['organizer']; ?></p>
        </div>

        <br><h3 class="use">Use of the raised money</h3>

        <div class="fund-right-info">
            
            <p><?php echo $fund['description']; ?></p><br>

            <img class="fund-info-pic"
                src="<?php echo $fund['eligibility']; ?>"
                alt="<?php echo $fund['name']; ?>"
                class="fund-image"
            ><br>
        </div>
    </section>

    <footer>
        <p>U Matter © 2026 All rights reserved</p>
    </footer>
</div>

<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>
