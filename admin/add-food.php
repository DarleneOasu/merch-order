<?php include('partials/menu.php'); ?>


<div class="main">
    <div class="wrapper">
        <h1>Add food</h1>

        <br><br>
        <?php 
            if (isset($_SESSION['add'])){ 
                echo $_SESSION['add'];  
                unset ($_SESSION['add']); 
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <br><br>

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the Item"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="description" cols='30' rows='5' placeholder="Description of the Item"></td>
                </tr>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql = "SELECT * FROM tbl_category
                                WHERE active='Yes'";
                        
                            $res = mysqli_query($conn, $sql) or die(mysqli_error($con));

                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                
                                ?>
                                <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                <?php
                                }

                            }else{
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="Yes">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="Yes">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

    if(isset($_POST['submit'])){

        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price']; 
        $category = $_POST['category'];

        if(isset($_POST['featured']))
        {
         $featured = $_POST['featured'];
        } 
        else
        {
            $featured = 'No ';
        }

        if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                $ext = end(explode('.', $image_name));
                $image_name = $_FILES['image']['name'];

                if($image_name !=""){


                $image_name = "Food_".rand(000,999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload == false){
                    $_SESSION['upload'] = "<div class = 'error'>Failed to Upoad Image. </div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                    die();
                }
            }
        } 
        else
        {
            $image_name = "";
        }

        if(isset($_POST['active']))
        {
         $active = $_POST['active'];
        } 
        else
        {
            $active = 'No';
        }

        $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
        ";

        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($con));

        if($res2 == TRUE){
            $_SESSION['add']="<div class='success'>Added Food Successfully</div>";
            header("location:".SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['add']="<div class='error'>Faild to Add Food</div>";
            header("location:".SITEURL.'admin/add-food.php');
        }
    }
?>