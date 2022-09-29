<?php
    //Autorization -Access Control
    //Check wheater the user is logged in or not
    if(!isset($_SESSION['user']))
    {
        //User is not logged in with message
        $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>
