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
    $conn->delete('cart', "user_id = '" . $conn->fetch($user)['id'] . "' and fruit_id = '" . $conn->fetch($fruit)['id'] . "'");
    header("location: /store/pages/stat/cart.php");
}

else if ($mode == "purchases") {
    $id = postParams('id', $_GET);
    $conn->delete('sells', "id = '$id'");
    header("location: /store/pages/stat/purchases.php");
}