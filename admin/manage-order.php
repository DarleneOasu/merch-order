<?php include('partials/menu.php'); ?>
            <!---main -->
            <div class="main">
            <div class="wrapper">
    	        <h1> Manage Order </h1> 
                <br><br><br>
                <?php
                    if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Merch</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res  = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count > 0){
                            while($row=mysqli_fetch_assoc($res))
                            {
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
                            ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $merch ?></td>
                                <td><?php echo $price ?></td>
                                <td><?php echo $qty ?></td>
                                <td>
                                    <?php 
                                        if($status == "Ordered"){
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status == "On Delivery"){
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        elseif($status == "Delivered"){
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        else{
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                     ?>
                                </td>
                                <td><?php echo  $order_date ?></td>
                                <td><?php echo $customer_name ?></td>
                                <td><?php echo $customer_contact ?></td>
                                <td><?php echo $customer_email ?></td>
                                <td><?php echo $customer_address ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>
                                </td>
                            </tr>
                            <?php
                            }
                        }else{
                            echo "<td><td colspan='12' class='error'>Orders not Avaliable</td><tr>";
                        }
                        ?>
                </table>
    	        
            </div>
        </div>

<?php include('partials/footer.php'); ?>