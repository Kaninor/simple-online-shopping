<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');
require(__DIR__.'/../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$fruit_id_param = postParams('fruit', $_GET);

if ($fruit_id_param == null) {
    header("location: /store/pages/");
    exit;
}

$fruit = $conn->select('fruit', "id = '$fruit_id_param'");
$fruit = $conn->fetch($fruit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/store/css/style.css">
    <link rel="icon" href="/store/assets/logo1.png">
    <title>Buy Product</title>
</head>
<body class="buy-view-body">
    <div class="buy-view-container">
        <div style="margin-bottom: 30px;">
            <div class="auth-form-control" style="margin-bottom: 30px;">
                <label>User: <?= $_SESSION['username'] ?></label>
            </div>
            <div class="auth-form-control">
                <label>Fruit: <?= $fruit['name'] ?></label>
            </div>
        </div>
        <form method="POST" action="/store/pages/buy.controller.php">
            <input type="hidden" name='fruit' value="<?= $fruit['name'] ?>"/>
            <input type="hidden" name='user' value="<?= $_SESSION['username'] ?>"/>
            <div class="auth-form-control">
                <label for="card-id" class="auth-label">Card id :</label>
                <input id="card-id" type="text" name="card-id" class="auth-input-control" placeholder="Type here..." minlength="16" maxlength="16" required />
            </div>
            <div class="auth-form-control">
                <label for="address" class="auth-label">Address :</label>
                <textarea id="address" style="min-width: 592px; min-height: 150px; max-width: 592px; max-height: 150px;" type="text" name="address" class="auth-input-control" placeholder="Type here..." maxlength="255" required></textarea>
            </div>
            <div class="auth-form-control-submit">
                <input type="submit" class="auth-submit btn-green" value="Buy" />
                <button type="button" class="auth-link-btn" id="auth-link-btn">Return to home</button>
            </div>
        </form>
    </div>

    <script>
        const back_to_home_btn = document.getElementById("auth-link-btn")

        back_to_home_btn.addEventListener("click", () => {
            location.href = "/store/pages/";
        });
    </script>
</body>
</html>