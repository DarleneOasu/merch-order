<?php 
    include('../config/constants.php');
    $id = $_GET['id'];

    if(isset($_GET['id']) && isset($_GET['image_name']))
    { 
        $sql ="DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'> Food Deleted </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete'] = "<div  class='error'> Failed to delete food, try again later </div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
    }else{
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>