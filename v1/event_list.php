<?php include 'dbconnect.php'; $sql = "SELECT * FROM umatterdb.events"; $result = $conn->query($sql); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Events list</title>
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
        </header>
        <div class="hero">
            <h1>U Matter</h1>
            <h3>Organize. Protest. Win</h3>
        </div>
        <div class="info-search">
            <h3>Current volunteering events</h3>
            <p>Every person to attend makes an impact.<br>Thank you for your support!</p>
            <div class="search-bar">
                <form action="/search" method="GET">
                    <input type="text" name="q" placeholder="Search events...">
                    <button type="submit">
                    <img src="assets/search.png" alt="submit" width="10" height="10">
                    </button>
                </form>
            </div>
        </div>
        <ul id="event-list" class="event-list">
            <?php
            while($row = $result->fetch_assoc()) {
            echo "
            <li class='event-card'>
                <a href='event_info.php?id={$row['id']}' class='event-link'>
                    <img 
                        src='{$row['photo']}' 
                        alt='{$row['name']}'
                        class='event-image'
                    >
                    <div class='overlay'></div>
                    <div class='event-info'>
                        <h3>{$row['name']}</h3>
                        <span>" . date("Y-m-d H:i", strtotime($row['date_time'])) . "</span>
                    </div>
                </a>
            </li>
            ";
            }
            ?>
        </ul>
        <div class="btn">
            <a href="create_event.php">Add a new event</a>
        </div>
        <footer>
            <p>U Matter © 2026 All rights reserved</p>
        </footer>
    </div>
<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>
