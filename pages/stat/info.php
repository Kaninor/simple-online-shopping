<?php

session_start();

require(__DIR__.'/../../auth_validation.php');
require(__DIR__.'/../../Database.php');
require(__DIR__.'/../../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$user = postParams('user', $_GET);
$fruit = postParams('fruit', $_GET);
$mode = postParams('mode', $_GET);

if ($user == null || $fruit == null || $mode == null) {
    header("location: /store/pages/");
    exit;
}

if ($user != $_SESSION['username']) {
    header("location: /store/pages/");
    exit;
}

if ($mode != "cart" && $mode != "purchases") {
    header("location: /store/pages/");
    exit;
}

if ($mode == "cart") {
    $user = $conn->select('users', "username = '" . $user . "'");
    $fruit = $conn->select('fruit', "name = '" . $fruit . "'");
    $data = $conn->join(array("fruit.name as f_name", "cart.added_in as c_added_in"), 'cart', "fruit on fruit.id = cart.fruit_id", "user_id = '" . $conn->fetch($user)['id'] . "' and fruit_id = '". $conn->fetch($fruit)['id'] ."'");
}

else if ($mode == "purchases") {
    $id = postParams('id', $_GET);
    $user = $conn->select('users', "username = '" . $user . "'");
    $fruit = $conn->select('fruit', "name = '" . $fruit . "'");
    $data = $conn->join(array("fruit.name as f_name", "sells.bought_at as s_bought_at", "sells.address as s_address", "sells.card_id as s_card_id"), 'sells', "fruit on fruit.id = sells.fruit_id", "user_id = '" . $conn->fetch($user)['id'] . "' and fruit_id = '". $conn->fetch($fruit)['id'] ."' and sells.id = '$id'");
}

$data = $conn->fetch($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../assets/logo1.png">
    <title>Info</title>
</head>
<body style="background-color: rgb(77, 79, 134);">
    <?php if ($mode == "cart"): ?>
        <div class="cart-info-view">
            <label>Username : <?= $_SESSION['username'] ?></label><br>
            <label>Fruit : <?= $data['f_name'] ?></label><br>
            <label>Added In : <?= $data['c_added_in'] ?></label>
        </div>
    <?php elseif ($mode == "purchases"): ?>
        <div class="purchases-info-view">
            <label>Username : <?= $_SESSION['username'] ?></label><br>
            <label>Fruit : <?= $data['f_name'] ?></label><br>
            <label>Address : <?= $data['s_address'] ?></label><br>
            <label>Card Id : <?= $data['s_card_id'] ?></label><br>
            <label>Bought At : <?= $data['s_bought_at'] ?></label>
        </div>
    <?php endif; ?>
</body>
</html>