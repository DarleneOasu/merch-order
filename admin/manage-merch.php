<?php include('partials/menu.php'); ?>
            <!---main -->
            <div class="main">
            <div class="wrapper">
    	        <h1> Manage merch </h1>
                <br><br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                                                        
                    if(isset($_SESSION['not-merch-found']))
                    {
                        echo $_SESSION['not-merch-found'];
                        unset($_SESSION['not-merch-found']);
                    }
                ?>
                <br><br>
                <a href="<?php echo SITEURL; ?>admin/add-merch.php" class="btn-primary">Add merch</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions
                    </tr>
                    <?php

                        $sql = "SELECT * FROM tbl_merch";

                        $res  = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count > 0){
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $price ?></td>
                        <td>
                            <?php
                                if($image_name != ""){
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/merch/<?php echo $image_name ?>"width=100px>
                                <?php
                                }else{
                                    echo "<div class='error'>Image not added.</div>";
                                }
                            ?>
                                </td>

                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-merch.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-secondary">Update Merch</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-merch.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Merch</a>
                        </td>
                    </tr>
                    <?php
                            }
                    }else{
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Merch Added.</div></td>
                        </tr>

                        <?php

                    }   
                    ?>
                </table>   
            </div>
<?php include('partials/footer.php'); ?>