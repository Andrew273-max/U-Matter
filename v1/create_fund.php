<?php

session_start();

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $fund_goal = $_POST['fund_goal'];
    $end_date = $_POST['end_date'];
    $purpose = $_POST['purpose'];
    $organizer = $_POST['organizer'];
    $description = $_POST['description'];

    $sql = "INSERT INTO funds
    (name, fund_goal, end_date, purpose, organizer, description)
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sdssss",
        $name,
        $fund_goal,
        $end_date,
        $purpose,
        $organizer,
        $description,
    );

    if ($stmt->execute()) {

    $message = "Fund created successfully";

    } else {

    $message = "Creation failed";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel ="icon" type="image" href="assets/icon.png">
</head>
<body class="other">
    <header>
        <div class="topnav">
            <a href="index.html" class="active"><img class="back" src="assets/icon.png"></a>
            <!-- Navigation links (hidden by default) -->
            <div id="myLinks">
                <a href="login.php" id="authLink">Log in</a>
                <a href="fund_list.php">Funds</a>
                <a href="event_list.php">Events</a>
                <a href="contact.html">Contact us</a>
            </div>
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <a href="javascript:void(0);" class="menu" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header><br>

    <h2>Create a new fund</h2>

    <div class="login-form">
        <form class ="login" method="POST" enctype="multipart/form-data">
            
            <label for="name">Name of the fund</label>
            <input type="text" id="name" name="name" required>
            <br><br>
                        
            <label for="organizer">Name of the organizer</label>
            <input type="text" id="organizer" name="organizer" required>
            <br><br>

            <label for="purpose">Purpose of the fund</label>
            <input type="text" id="purpose" name="purpose">
            <br><br>
            
            <label for="fund_goal">Fund goal</label>
            <input type="number" min="1" step=".01" id="fund_goal" name="fund_goal" placeholder="€" required>
            <br><br>

            <label for="end_date">End date</label>
            <input type="date" id="end_date" name="end_date" min="2014-01-01">
            <br><br>
                        
            <label for="description">Description of the fund</label>
            <textarea id="description" name="description" placeholder="Tell us more about your fund..." required></textarea>
            <br><br>

            <label for="eligibility">Verification Document</label>
            <input type="file" name="eligibility" id="eligibility" required>
            <br><br>

            <button class="message" type="submit">Send the application</button>
        </form>
    </div>

    <?php if (!empty($message)) : ?>

    <h4 class="success-message">
        <?php echo $message; ?>
    </h4>

    <?php endif; ?>
    <br>

    <footer>
        <p>U Matter © 2026 All rights reserved</p>
    </footer>

<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>
