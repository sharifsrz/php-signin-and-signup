<?php

include 'db.php';

global $conn;

$result = mysqli_query($conn, "select * from user");
$try_login = false;
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $try_login = true;

    $email = $_POST['email'];
    $password = $_POST['password'];

    while ($user = mysqli_fetch_assoc($result)) {
        if ($user['email'] == $email && $user['password'] === $password) {
            $_SESSION['user_data'] = $user;
            $_SESSION['login'] = true;
        }
    }


    if (!isset($_SESSION['login']) || !$_SESSION['login']) {
        $error_msg = "Wrong Accses";
    }

}

if (isset($_SESSION['login']) && $_SESSION['login']) {
    header("Location: /profile.php");
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#06aa5e">
    <meta name="msapplication-navbutton-color" content="#06aa5e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Sign In | Basket ™</title>
    <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <main class="card-container slideUp-animation">
        <div class="image-container">
            <h1 class="company">Basket <sup>&trade;</sup></h1>
            <img src="./assets/images/signUp.svg" class="illustration" alt="">
            <p class="quote">Sign In today to get exciting offers..!</p>
            <a href="#btm" class="mobile-btm-nav">
                <img src="./assets/images/dbl-arrow.png" alt="">
            </a>
        </div>
        <form action="" method="POST">
            <div class="form-container slideRight-animation">

                <h1 class="form-header">
                    Get started
                </h1>

                <?php
                if ($try_login && !empty($error_msg)) {
                    ?>
                <h2><?php echo $error_msg; ?></h2>

                <?php
                }

                ?>

                <div class="input-container">
                    <label for="mail">
                    </label>
                    <input type="email" name="email" id="mail" required autocomplete="off">
                    <span>
                        E-mail
                    </span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="user-password-confirm"></label>
                    <input type="password" name="password" id="user-password-confirm" class="password-confirmation"
                        required autocomplete="off">
                    <span>
                        Password
                    </span>
                    <div class="error"></div>
                </div>

                <div id="btm">
                    <button type="submit" class="submit-btn">Login</button>
                    <p class="btm-text">
                        You have a don't account please sign up..? <a href="/signup.php"><span
                                class="btm-text-highlighted"> Log in</span></a>
                    </p>
                </div>
            </div>
        </form>
    </main>
    <section class="outro-overlay disabled slideUp-animation">
        <h1 class="company">Basket <sup>&trade;</sup></h1>
        <h1 class="outro-greeting">Thank's for signing up..!</h1>
        <img src="./assets/images/shape.svg" alt="" class="shape">
        <img src="./assets/images/signedUp.svg" alt="" id="signedUp-illustration" class="slideRight-animation">
        <div class="author-link">
            &copy;&nbsp;
            <a href="https://www.0xabdulkhalid.ml/">0xabdulkhalid</a> |
            <a href="https://www.github.com/0xabdulkhalid/basket-sign-up-form/">Source Code</a>
        </div>
    </section>
</body>

</html>