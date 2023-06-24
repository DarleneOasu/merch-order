<?php include('partials/menu.php'); ?>

<div class="main">
   <div class="wrapper">
      <h1>Update Merch</h1>
      <br><br>

      <?php
         if(isset($_GET['id'])){
            $id=$_GET['id'];

            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            $res=mysqli_query($conn, $sql);

            if($res == true){
               $count = mysqli_num_rows($res);
               if($count == 1){
                  $row = mysqli_fetch_assoc($res);

                  $id = $row['id'];
                  $merch = $row['merch'];
                  $price = $row['price'];
                  $qty = $row['qty'];
                  $order_date = $row['order_date'];
                  $status = $row['status'];
                  $customer_name = $row['customer_name'];
                  $customer_contact = $row['customer_contact'];
                  $customer_email = $row['customer_email'];
                  $customer_address = $row['customer_address'];
               }
               else{
                  $_SESSION['not-merch-found'] = "<div class='error'>Merch not found.</div>";
                  header('location:'.SITEURL.'admin/manage-order.php');
               }
            }
         }else{
            header('location:'.SITEURL.'admin/manage-order.php');
         }

      ?>

      <form action="" method="POST" enctype="multipart/form-data">
      
         <table class="tbl-30">
            <tr>
               <td>Merch Name:</td>
               <td><b><?php echo $merch ?></b></td>
            </tr>
            <tr>
               <td>Price:</td>
               <td><b><?php echo $price ?>€</b></td>
            </tr>
            <tr>
               <td>Qty:</td>
               <td>
                  <input type="number" name="qty" value="<?php echo $qty; ?>">
               </td>
            </tr>
            <tr>
               <td>Status:</td>
               <td>
                  <select name="status">
                  <option <?php if($status =="Ordered") {echo "selected";} ?> value="Ordered">Ordered</option>
                  <option <?php if($status =="On Delivery") {echo "selected";} ?> value="On Delivery">On Delivery</option>
                  <option <?php if($status =="Delivered") {echo "selected";}?> value="Delivered">Delivered</option>
                  <option <?php if($status =="Cancelled") {echo "selected";} ?> value="Cancelled">Cancelled</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Cusomer Name:</td>
               <td>
                  <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
               </td>
            </tr>
            <tr>
               <td>Cusomer Email:</td>
               <td>
               <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
               </td>
            </tr>
            <tr>
               <td>Cusomer Contact:</td>
               <td>
               <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
               </td>
            </tr>
            <tr>
               <td>Cusomer Address:</td>
               <td>
               <input type="text" name="customer_address" value="<?php echo $customer_address; ?>">
               </td>
            </tr>
            <tr>
               <td colspan=2>
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <input type="hidden" name="price" value="<?php echo $price; ?>">
               <input type="submit" name="submit" value="Update Order" class="btn-secondary">
               </td>
            </tr>

         </table>

      </form>
      <?php
         if(isset($_POST['submit'])){
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            $sql2 = "UPDATE tbl_order SET 
                         qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact ='$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        WHERE id=$id
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == true){
                        $_SESSION['update'] = "<div class='success text-center'>Ordered updated Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-order.php');

                    }else{
                        $_SESSION['update'] = "<div class='error text-center'>Ordered not updated successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }

         }
      ?>
   </div>
</div>  
<?php include('partials/footer.php'); ?>