<?php


// destroy the session and check to make sure it has been destroyed
session_destroy();
    if(!session_is_registered('username')){
        $loginMessage = 'You have been logged out.';
        include 'home1.php';
        exit();
    }
?>