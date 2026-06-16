<?php

session_start();

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $profile_pic_name = $_FILES['profile_pic']['name'];
    $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];

    $profile_pic_path = "uploads/" . time() . "_" . $profile_pic_name;

    move_uploaded_file($profile_pic_tmp, $profile_pic_path);

    $proof_name = $_FILES['proof_eligibility']['name'];
    $proof_tmp = $_FILES['proof_eligibility']['tmp_name'];
    $proof_path = "uploads/" . time() . "_" . $proof_name;

    move_uploaded_file($proof_tmp, $proof_path);

    $sql = "INSERT INTO accounts
    (first_name, last_name, phone_number, email, pass, profile_pic, proof_eligibility)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssss",
        $first_name,
        $last_name,
        $phone_number,
        $email,
        $password,
        $profile_pic_path,
        $proof_path,
    );

    if ($stmt->execute()) {

    header("Location: login.php");
    exit();
    $message = "Account created successfully";

    } else {

    $message = "Signup failed";

    }

}

?>

<!DOCTYPE html>
<html>
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

    <br><h2>Sign up</h2>

    <br><div class="login-form">
        <form class ="login" method="POST" enctype="multipart/form-data">
            <label for="first_name">First name</label>
            <input type="text" name="first_name" id="first_name" required>
            <br><br>

            <label for="last_name">Last name</label>
            <input type="text" name="last_name" id="last_name" required>
            <br><br>

            <label for="phone_number">Phone number</label>
            <input type="text" name="phone_number" id="phone_number" required>
            <br><br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <br><br>

            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" required>
            <br><br>

            <label for="profile_pic">Profile Picture</label>
            <input type="file" name="profile_pic" id="profile_pic" required>
            <br><br>

            <label for="proof_eligibility">Verification Document</label>
            <input type="file" name="proof_eligibility" id="proof_eligibility" required>
            <br><br>

            <button class="message" type="submit">Create Account</button>
        </form>
    </div>

    <h4>Already have an account?</h4>
    <a class="message" href="login.php">Log in</a>

    <?php if (!empty($message)) : ?>

    <h4 class="success-message">
        <?php echo $message; ?>
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
