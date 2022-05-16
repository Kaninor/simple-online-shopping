<?php 

require(__DIR__.'/../auth_validation.php');

session_start(); 
auth_validator('/store/pages/auth/login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../assets/logo1.png">
    <title>Contact Us</title>
</head>
<body>
    <!-- header -->
    <?php require(__DIR__."/components/header.php") ?>
    <!-- end of header -->

    <!-- nav -->
    <nav id="navbar">
        <?php require(__DIR__."/components/nav.php") ?>
    </nav>
    <!-- end of nav  -->

    <main>
        <div class="contact-us-container">
            <div class="form-container">
                <form method="POST" action="/store/pages/contactUs.controller.php">
                    <div class="form-control-contact-us">
                        <label for="problem" class="form-label">Is There Any Problem ?</label>
                        <input id="problem" class="form-input" type="text" name="problem" placeholder="Type here..." required />
                    </div>
                    <div class="form-control-contact-us">
                        <label for="user-email" class="form-label">Email : </label>
                        <input id="user-email" class="form-input" type="email" name="user-email" placeholder="Type here..." required />
                    </div>
                    <div class="form-control-contact-us">
                        <label for="user-phonenumber" class="form-label">Phone Number (Optional) : </label>
                        <input id="user-phonenumber" class="form-input" type="tel" name="user-phonenumber" placeholder="Type here..." />
                    </div>
                    <div class="form-control-contact-us">
                        <input class="form-submit" type="submit" />
                    </div>
                </form>
            </div>

            <img class="email-icon" src="../assets/email/email1.png" />
        </div>
        
        <p class="contactus-desc">
            Here you can tell us our bugs and we check it and then we will fix those bugs.<br>
            problem and email boxes are required but the phonenumber box is unrequired.<br>
            after fixing the bugs we will send you a message to your email and to your phonenumber if you've filled it.
        </p>
    </main>


    <footer>Online Shopping	&copy;</footer>

    <script src="../js/contactUs.js"></script>
</body>

    <?php if ($_SESSION['contact-us-msg'] == 1): ?>
        <?php $_SESSION['contact-us-msg'] = 0; ?>
        <script>alert("Problem sent successfully!")</script>
    <?php elseif ($_SESSION['contact-us-msg'] == 2): ?>
        <?php $_SESSION['contact-us-msg'] = 0; ?>
        <script>alert("Error in sending the problem!")</script>
    <?php endif; ?>
</html>
