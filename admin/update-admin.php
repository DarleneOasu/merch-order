<?php include('partials/menu.php'); ?>

<div class="main">
   <div class="wrapper">
      <h1>Update Admin</h1>
      <br><br>

      <?php
         //Get the ID of the Selected Admin
         $id=$_GET['id'];

         //Creat SQL Query to Get the Details
         $sql = "SELECT * FROM tbl_admin WHERE id=$id";

         //Execute the Query
         $res=mysqli_query($conn, $sql);

         //Check whether the query is executer or not
         if($res == true){
            //Check whether the data is avaliable or not
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if($count == 1){
               //Get the Details
               //echo "Admin Avaliable";
               $row = mysqli_fetch_assoc($res);

               $full_name = $row['full_name'];
               $username = $row['username'];
            }
            else{
               //Redirect to Manage Admin Page
               header('location:'.SITEURL.'admin/manage-admin.php');
            }
         }

      ?>

      <form action="" method="POST">
      
         <table class="tbl-30">
            <tr>
               <td>Full name:</td>
               <td>
                  <input type="text" name="full_name" value="<?php echo $full_name; ?>">
               </td>
            </tr>
            <tr>
               <td>Username:</td>
               <td>
                  <input type="text" name="username" value="<?php echo $username; ?>">
               </td>
            </tr>
            <tr>
               <td colspan=2>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
               </td>
            </tr>

         </table>

      </form>
   </div>
</div>  

<?php 

  
   //Check if the Submit button is Clicked or not
   if(isset($_POST['submit']))
   {
      //echo "Button Clicked";
      //Get all the values from the form to update
      $id = $_POST['id'];
      $full_name= $_POST['full_name'];
      $username = $_POST['username'];

      //Create a SQL Query to Update Admin
      $sql ="UPDATE tbl_admin SET
      full_name = '$full_name',
      username = '$username' 
      WHERE id='$id'
      ";

      //Execute Query
      $res= mysqli_query($conn, $sql);

      //Check if the Query Executed successfully or not
      if($res==true){
         //Query Executed and Admin Updated
         $_SESSION['update'] = " <div class = 'succes'>Admin Update Successfully </div>";
         header('location:'.SITEURL.'admin/manage-admin.php');
      
      }
      else{
         //Failed to Update Admin
         $_SESSION['update'] = " <div class = 'succes'>Failed to Update Admin </div>";
         header('location:'.SITEURL.'admin/manage-admin.php');
      }
   }

?>
<?php include('partials/footer.php'); ?>