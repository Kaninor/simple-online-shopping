<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');
require(__DIR__.'/../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$problem = postParams('problem', $_POST);
$email = postParams('user-email', $_POST);
$phonenumber = postParams('user-phonenumber', $_POST);

if ($problem != null && $email != null) 
{
    if ($conn->insert('problems', array('problem', 'email', 'phonenumber'), array("'$problem'", "'$email'", "'$phonenumber'")))
    {
        $_SESSION['contact-us-msg'] = 1;
        header("location: /store/pages/contactUs.php");
    }
    else 
    {
        $_SESSION['contact-us-msg'] = 2;
        header("location: /store/pages/contactUs.php");
    }
}
