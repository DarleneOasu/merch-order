<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <h1 class="text-center">Login</h1>
            <br><br>
            <!--LOGIN FORM -->
            <form action="" method="POST" class="text-center">
                User name:
                <br>
                <input type="text" name="username" placeholder="Enter User Name">
                <br><br>
                Password:
                <br>
                <input type="password" name="password" placeholder="Enter Passeword">
                <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
                <p class="text-center">Created By - <a href="#">Vera Vrbanic</a></p>
        </div>
    </body>
</html>

<?php 

    //Check if the submit button is clicked
    if(isset($_POST['submit'])){
        //Process for Login
        //1. Get the Data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. Does username and password exist in SQL
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check wheather the user exists or not
        $count = mysqli_num_rows($res);

        if($count == 1){
            //User Avaliable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username; //To chech wheater the user is logged in or not
            //Redirect to homepage
            header('location:'.SITEURL.'admin/');
        }
        else{
            //User not Avalible and Login Failed
            $_SESSION['login']="<div class='error'>Login Failed</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

 

?>