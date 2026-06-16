<?php

session_start();

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM accounts WHERE email = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // VERIFY HASHED PASSWORD
        if (password_verify($password, $user['pass'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "<script>
                localStorage.setItem('loggedIn', 'true');
                window.location.href = 'profile.php';
            </script>";

            exit();

        } else {

            echo "Incorrect password";

        }

    } else {

        echo "No account found";

    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Matter - Login</title>
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
                <a id="authLink" href="login.php">Log in</a>
                <a href="fund_list.php">Funds</a>
                <a href="event_list.php">Events</a>
                <a href="contact.html">Contact us</a>
            </div>
            <a href="javascript:void(0);" class="menu" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <br><h2>Log in</h2>
    <br><div class="login-form">
        <form class ="login" method="POST">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
            <br><br>

            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" required>
            <br><br>
            <button class="message" type="submit">Login</button>
        </form>
        <br><br>
    </div>

    <br><h4>Don't have an account?</h4>
    <a class="message" href="signup.php">Sign up</a><br>

    <footer>
        <p>U Matter © 2026 All rights reserved</p>
    </footer>
</div>

<script src="js/shared/hamburger_menu.js"></script>
</body>
</html>
