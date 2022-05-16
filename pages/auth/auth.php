<?php

session_start();

require(__DIR__.'/../../Database.php');
require(__DIR__.'/../../functions.php');

$conn = new Database();

$username = postParams('username', $_POST);
$email = postParams('email', $_POST);
$password = postParams('password', $_POST);
$mode = postParams('mode', $_POST);

if ($username != null && $email != null && $password != null && $mode == 'signup')
{
    $result = $conn->select('users', "username = '$username' or email = '$email'");
    if ($conn->count($result) == 0) {
        $conn->insert('users', array('username', 'email', 'password'), array("'$username'", "'$email'", "'". encoding($password) . "'"));
        $_SESSION['logedin'] = 1;
        $_SESSION['username'] = $username;
        $_SESSION['sign-msg'] = 1;
        header('Location: '. '/store/pages/');
    } else {
        $_SESSION['sign-msg'] = 0;
        header('Location: '. '/store/pages/auth/signup.php');
    }
}
else if ($mode = 'login' && $email != null && $password != null)
{
    $result = $conn->select('users', "email = '$email' and password = '" . encoding($password) . "'");
    if ($row = $conn->fetch($result))
    {
        $_SESSION['logedin'] = 1;
        $_SESSION['username'] = $row['username'];
        $_SESSION['log-msg'] = 1;
        header('Location: '. '/store/pages/');
    }
    else {
        $_SESSION['log-msg'] = 0;
        header('Location: '. '/store/pages/auth/login.php');
    }
}
else if ($_GET['logout'] == 1)
{
    $_SESSION['logedin'] = 0;
    $_SESSION['username'] = "";
    header('Location: '. '/store/pages/');
}