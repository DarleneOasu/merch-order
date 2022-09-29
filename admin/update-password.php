<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1> Change Password </h1>
        <br><br>
        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">
         <table class="tbl-30">

            <tr>
               <td>Current password:</td>
               <td>
                  <input type="password" name="current_password" placeholder="Current password">
               </td>
            </tr>

            <tr>
               <td>New password:</td>
               <td>
                  <input type="password" name="new_password" placeholder="New password">
               </td>
            </tr>

            <tr>
               <td>Confirm password:</td>
               <td>
                  <input type="password" name="confirm_password" placeholder="Confirm password">
               </td>
            </tr>

            <tr>
               <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
               </td>
            </tr>
         </table>
      </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        //echo "Clicked";

        //1. Get the data from Form
        $id = $_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


        //2. Check whether the user with current ID and Current Password Exist or Not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //Execute the query
        $res=mysqli_query($conn, $sql);

        if($res==true){
            //Check if data is avaliable
            $count = mysqli_num_rows($res);

            if ($count == 1)
            {
                //User exists and password can be changes
                //echo "User found";
                //Check whether the new password and confirm password match or not
                if($new_password == $confirm_password){
                    //Update the password
                    $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id";

                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == true)
                    {
                        $_SESSION['change-pwd'] ="<div class='success'>Passwords changed!</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['not-changed-pwd'] ="<div class='error'>Failed to change password</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else{
                    //Redirect to Manage Admin Page with Error Message
                    $_SESSION['passwords do not match'] ="<div class='error'>Passwords do not match</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else{
                //User does not exist
                $_SESSION['user not found'] = "<div class='error'>User not found </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
                

            }
        }


        //3. Chech Whether the New Password and Confirm Password atch or not

        //4. Change Password if all above is true
    }
?>
<?php include('partials/footer.php'); ?>