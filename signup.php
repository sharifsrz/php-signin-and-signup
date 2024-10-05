<?php
include 'db.php';

global $conn;

$is_error = false;
$errors_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $f_name = mysqli_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_escape_string($conn, $_POST['l_name']);
    $address = mysqli_escape_string($conn, $_POST['address']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];


    $sql1 = "select * from user where email='$email'";

    $email_result = mysqli_query($conn, $sql1);

    $totale_email = mysqli_num_rows($email_result);
    ;

    if ($totale_email > 0) {
        $is_error = true;
        $errors_msg = "this email used";
        $error_msg = "This email address is already associated with an existing account. Please use a different email or";
    }

    if (!$is_error) {

        $sql = "insert into user(`f_name`,`l_name`,`address`,`email`,`phone`,`password`) values( '$f_name','$l_name','$address','$email','$phone','$password')";

        $register_data = mysqli_query($conn, $sql);

        if (!$register_data) {
            $is_error = true;
            $msg = "Somehting wrong !";
        }

    }

    if (!$is_error) {
        header("Location: /profile.php");
    }

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
    <title>Sign up | Basket ™</title>
    <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <main class="card-container slideUp-animation">
        <div class="image-container">
            <h1 class="company">Basket <sup>&trade;</sup></h1>
            <img src="./assets/images/signUp.svg" class="illustration" alt="">
            <p class="quote">Sign up today to get exciting offers..!</p>
            <a href="#btm" class="mobile-btm-nav">
                <img src="./assets/images/dbl-arrow.png" alt="">
            </a>
        </div>
        <form action="" method="POST">
            <div class="form-container slideRight-animation">

                <h1 class="form-header">
                    Get started
                </h1>

                <?php if ($is_error) {

                    ?>


                <h2><?php echo $errors_msg; ?></h2>
                <p><?php echo $error_msg; ?></p>




                <?php
                } ?>

                <div class="input-container">
                    <label for="f-name"></label>
                    <input type="text" name="f_name" id="f-name" required autocomplete="off">
                    <span>
                        First name
                    </span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="l-name"></label>
                    <input type="text" name="l_name" id="l-name" required autocomplete="off">
                    <span>
                        Last name
                    </span>
                    <div class="error"></div>
                </div>

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
                    <label for="phone">
                    </label>
                    <input type="tel" name="phone" id="phone" required autocomplete="off">
                    <span>Phone</span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="user-password"></label>
                    <input type="text" name="address" id="user-password" class="user-password" autocomplete="off"
                        required>
                    <span>Address</span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="user-password-confirm"></label>
                    <input type="password" name="password" id="user-password-confirm" autocomplete="off"
                        class="password-confirmation" required>
                    <span>
                        Password
                    </span>
                    <div class="error"></div>
                </div>

                <div id="btm">
                    <button type="submit" class="submit-btn">Create Account</button>
                    <p class="btm-text">
                        Already have an account..? <a href="/login.php"><span class="btm-text-highlighted"> Log
                                in</span></a>
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