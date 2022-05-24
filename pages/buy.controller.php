<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');
require(__DIR__.'/../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$user = postParams('user', $_POST);
$fruit = postParams('fruit', $_POST);
$card_id = postParams('card-id', $_POST);
$address = postParams('address', $_POST);

$user_id = $conn->select('users', "username = '$user'");
$fruit_id = $conn->select('fruit', "name = '$fruit'");

$user_id = $conn->fetch($user_id)['id'];
$fruit_id = $conn->fetch($fruit_id)['id'];

$conn->insert('sells', array('user_id', 'fruit_id', 'address', 'card_id'), array("'$user_id'", "'$fruit_id'", "'$address'", "'$card_id'"));
header('location: /store/pages');