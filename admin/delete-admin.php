<?php 

    //Include constant.php 
    include('../config/constants.php');
    //1. get the ID of Admin to be deleted
    $id = $_GET['id'];


    //2. Create SQL Query to Delete Admin
    $sql ="DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check if the Quesy is executed successfully
    if($res==TRUE){
        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'> Admin Deleted </div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //echo "Fail to delete admin";
        $_SESSION['delete'] = "<div  class='error'> Failed to delete admin, try again later </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

    //3. Redirect to Manage Admin page with message(success/error)

?>