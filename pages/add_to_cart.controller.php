<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');
require(__DIR__.'/../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// echo $data["fruit-name"] . " - " . $data['username'];

$fruit_result = $conn->select('fruit', "name = '" . $data['fruit-name'] . "'");
$user_result = $conn->select('users', "username = '" . $data['username'] . "'");

$fruit = $conn->fetch($fruit_result);
$user = $conn->fetch($user_result);

// echo $user['username'] . " - " . $fruit['name'];

if ($fruit == null || $user == null)
    exit;

if ($data["mode"] == 1)
    $conn->insert('cart', array('user_id', 'fruit_id'), array($user['id'], $fruit['id']));
else if ($data["mode"] == 0)
    $conn->delete('cart', "user_id = '" . $user['id'] . "' AND fruit_id = '" . $fruit['id'] . "'");