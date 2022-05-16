<?php

function auth_validator($redirect_url)
{
    if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == 0)
    {
        header('Location: '. $redirect_url);
    }
    else if (!isset($_SESSION['logedin'])) 
    {
        header('Location: '. '/store/pages/auth/login.php');
    }
}