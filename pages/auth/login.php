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
    <title>Login</title>
</head>
<body class="auth-body">
    <div class="auth-container">
        <?php if (isset($_SESSION['log-msg']) && $_SESSION['log-msg'] == 0): ?>
            <span style="display: block; color: red; margin-bottom: 10px;">Either email is incorrect or password!</span>
            <?php $_SESSION['log-msg'] = 1; ?>
        <?php endif; ?>
        <form action="./auth.php" method="POST">
            <input type="hidden" name='mode' value="login">
            <div class="auth-form-control">
                <label for="email" class="auth-label">Email :</label>
                <input id="email" type="email" name="email" class="auth-input-control" placeholder="Type here..." maxlength="50" minlength="10" required />
            </div>
            <div class="auth-form-control">
                <label for="password" class="auth-label">Password :</label>
                <input id="password" type="password" name="password" class="auth-input-control" placeholder="Type here..." maxlength="40" minlength="8" required />
            </div>
            
            <div class="auth-form-control-submit">
                <input type="submit" class="auth-submit btn-blue" value="Login" />
                <button type="button" class="auth-link-btn" id="auth-link-btn">Don't have an account ?</button>
            </div>
        </form>
    </div>

    <script>
        const back_to_home_btn = document.getElementById("auth-link-btn")

        back_to_home_btn.addEventListener("click", () => {
            location.href = "/store/pages/auth/signup.php";
        });
    </script>
</body>
</html>