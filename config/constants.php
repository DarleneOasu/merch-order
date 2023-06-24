<?php
    //Start Session
    session_start(); 


    //Create constan to stor non repeating values
    define('SITEURL', 'http://localhost/merch-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'merch-order');

    //3. Execure Query and Save Data in Database 
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //Selection Database
?>