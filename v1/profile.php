<?php

session_start();

include 'dbconnect.php';

// CHECK LOGIN
if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM accounts WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Profile</title>
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
            <div id="myLinks">
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

    <br><img class="pic" src="<?php echo $user['profile_pic']; ?>">
        
    <h2>Your account</h2>

    <section class="profile">        
        <h4>
            <?php echo $user['first_name']; ?>
            <?php echo $user['last_name']; ?>
        </h4>

        <h5><?php echo $user['email']; ?></h5><br>

        <h5>Activities</h5>
        <p>Displays where you took part in. 
           For example, what funds you donated to, what events you attended and what you organized. 
           Function will be implemented in future development.</p>

        <h5>Bio</h5>
        <p>Displays your short bio. Will be updated with user input.
           Can contain anything: from personal info to the user's accomplishments.
           Function will be implemented in the future development.</p>

        <a class="account" href="logout.php">Logout</a>
    </section>

    <br><footer>
        <p>U Matter © 2026 All rights reserved</p>
    </footer>

    <script src="js/shared/hamburger_menu.js"></script>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel ="icon" type="image" href="assets/icon.png">
</head>
<body class="profile">
    <header>

    </header>
</body>
</html> -->