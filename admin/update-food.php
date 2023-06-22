<?php include('partials/menu.php'); ?>

<div class="main">
   <div class="wrapper">
      <h1>Update Food</h1>
      <br><br>

      <?php
         $id=$_GET['id'];

         $sql = "SELECT * FROM tbl_food WHERE id=$id";

         $res=mysqli_query($conn, $sql);

         if($res == true){
            $count = mysqli_num_rows($res);
            if($count == 1){
               $row = mysqli_fetch_assoc($res);

               $title = $row['title'];
               $description = $row['description'];
               $price = $row['price'];
               $category= $row['category_id'];
               $current_image = $row['image_name'];
               $featured = $row['featured'];
               $active = $row['active'];
            }
            else{
               $_SESSION['not-food-found'] = "<div class='error'>Food not found.</div>";
               header('location:'.SITEURL.'admin/manage-food.php');
            }
         }

      ?>

      <form action="" method="POST" enctype="multipart/form-data">
      
         <table class="tbl-30">
            <tr>
               <td>Title:</td>
               <td>
                  <input type="text" name="title" value="<?php echo $title; ?>">
               </td>
            </tr>
            <tr>
               <td>Description:</td>
               <td>
                  <input type="text" name="description" value="<?php echo $description; ?>">
               </td>
            </tr>
            <tr>
               <td>Price:</td>
               <td>
                  <input type="number" name="price" value="<?php echo $price; ?>">
               </td>
            </tr>
            <tr>
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
                           $category_id = $row['id'];
                           $category_title = $row['title'];
                        ?>
                        <option value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
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
               <td>Current Image:</td>
               <td>
                  <?php
                     if($current_image != ""){

                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width='100px'>
                        <?php
                     }else{
                        echo "<div class='primary'>Image not found.</div>";
                     }
                  ?>
               </td>
            </tr>
            <tr>
               <td>New Image:</td>
               <td>
                  <input type="file" name="image">
               </td>
            </tr>
            <tr>
               <td>Featured:</td>
               <td>
                  <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                  <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
               </td>
            </tr>
            <tr>
               <td>Active:</td>
               <td>
                  <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                  <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
               </td>
            </tr>
            <tr>
               <td colspan=2>
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
               <input type="submit" name="submit" value="Update Food" class="btn-secondary">
               </td>
            </tr>

         </table>

      </form>
   </div>
</div>  

<?php
      if(isset($_POST['submit'])){

         $id = $_POST['id'];
         $title = $_POST['title'];
         $description = $_POST['description'];
         $price = $_POST['price'];
         $category_id = $_POST['category'];
         $current_image = $_POST['image_name'];
         $featured = $_POST['featured'];
         $active = $_POST['active'];

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
                     $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                     header('location:'.SITEURL.'admin/manage-food.php');
                     die();
                  }
                     if($current_image != ""){
                        $remove_path="../images/food/".$current_image;
                        $remove=unlink($remove_path);

                        if($remove == false){
                           $_SESSION['failed-remove'] ="<div class = 'error'>Failed to Remove Current Image. </div>";
                           header('location:'.SITEURL.'admin/manage-food.php');
                           die();
                        }
                  }
               }
               else{
                  $image_name = $current_image;
               }
         } 
         else
         {
               $image_name = $current_image;
         }
    
         $sql2 = "UPDATE tbl_food SET
               title = '$title',
               image_name = '$image_name',
               featured = '$featured',
               active = '$active'
               WHERE id=$id;
         ";
   
         $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($con));
   
         if($res2 == TRUE){
               $_SESSION['add']="<div class='success'>Food Updated Successfully</div>";
               header("location:".SITEURL.'admin/manage-food.php');
         }
         else{
               $_SESSION['add']="<div class='error'>Faild to Update Food</div>";
               header("location:".SITEURL.'admin/manage-food.php');
         }

        }
        ?>
<?php include('partials/footer.php'); ?>