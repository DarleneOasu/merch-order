<!-- add an admin with details and save in database-->
<?php include('partials/menu.php'); ?>


<div class="main">
    <div class="wrapper">
        <h1>Add admin</h1>

        <br><br>
        <?php 
            if (isset($_SESSION['add'])){ //Check whether the session is set or not
                echo $_SESSION['add'];  //Dislplay session message
                unset ($_SESSION['add']); //Remove session message
            }
        ?>
        <form action="" method="POST">

            <br><br>

            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //process the value from form and save it in our database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){

        //Button Clicked
        //echo "Button Clicked";

        //1.Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //2.SQL Query to Save the date into database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        //3. Execure Query and Save Data in Database 
        $res = mysqli_query($conn, $sql) or die(mysqli_error($con));

        //4. Check whether the (Query is Executed)data is inserted or not and display appropriate message
        if($res == TRUE){
            //echo "Data inserted";
            //Create a variable to display a message
            $_SESSION['add']="Admin Added Successfully";
            //Redirect page manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //echo "Data not inserted";
            //Create a variable to display a message
            $_SESSION['add']="Faild to Add Admin";
            //Redirect page add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>