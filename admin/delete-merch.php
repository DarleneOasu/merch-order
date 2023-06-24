<?php 
    include('../config/constants.php');
    $id = $_GET['id'];

    if(isset($_GET['id']) && isset($_GET['image_name']))
    { 
        $sql ="DELETE FROM tbl_merch WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'> Merch Deleted </div>";
            header('location:'.SITEURL.'admin/manage-merch.php');
        }
        else{
            $_SESSION['delete'] = "<div  class='error'> Failed to delete merch, try again later </div>";
            header('location:'.SITEURL.'admin/manage-merch.php');

        }
    }else{
        header('location:'.SITEURL.'admin/manage-merch.php');
    }

?>