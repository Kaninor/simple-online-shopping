<?php 

session_start();

if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == 1)
{
    header('Location: '. '/store/pages/');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../assets/logo1.png">
    <title>Sign Up</title>
</head>
<body class="auth-body">
    <div class="auth-container">
        <?php if (isset($_SESSION['sign-msg']) && $_SESSION['sign-msg'] == 0): ?>
            <span style="display: block; color: red; margin-bottom: 10px;">User exists!</span>
            <?php $_SESSION['sign-msg'] = 1; ?>
        <?php endif; ?>
        <form method="POST" action="./auth.php">
            <input type="hidden" name='mode' value="signup">
            <div class="auth-form-control">
                <label for="username" class="auth-label">Username :</label>
                <input id="username" type="text" name="username" class="auth-input-control" placeholder="Type here..." maxlength="25" minlength="5" required />
            </div>
            <div class="auth-form-control">
                <label for="email" class="auth-label">Email :</label>
                <input id="email" type="email" name="email" class="auth-input-control" placeholder="Type here..." maxlength="50" minlength="10" required />
            </div>
            <div class="auth-form-control">
                <label for="password" class="auth-label">Password :</label>
                <input id="password" type="password" name="password" class="auth-input-control" placeholder="Type here..." maxlength="40" minlength="8" required />
            </div>
            <div class="auth-form-control-submit">
                <input type="submit" class="auth-submit btn-green" value="Sign Up" />
                <button type="button" class="auth-link-btn" id="auth-link-btn">Already have an account ?</button>
            </div>
        </form>
    </div>

    <script>
        const back_to_home_btn = document.getElementById("auth-link-btn")

        back_to_home_btn.addEventListener("click", () => {
            location.href = "/store/pages/auth/login.php";
        });
    </script>
</body>
</html>