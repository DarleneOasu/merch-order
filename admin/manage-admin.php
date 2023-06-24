<?php include('partials/menu.php');?>
        <!---main -->
        <div class="main">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
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
                    if(isset($_SESSION['user not found']))
                    {
                        echo $_SESSION['user not found'];
                        unset($_SESSION['user not found']);
                    }
                    if(isset($_SESSION['passwords do not match']))
                    {
                        echo $_SESSION['passwords do not match'];
                        unset($_SESSION['passwords do not match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                
                    if(isset($_SESSION['not-changed-pwd']))
                    {
                        echo $_SESSION['not-changed-pwd'];
                        unset($_SESSION['not-changed-pwd']);
                    }
                ?>

                <br><br>
                <!--Button to add admin-->
                <a href="add-admin.php" class="btn-primary">Add admin</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full name</th>
                        <th>User name</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);

                        if($res == TRUE){
                            $count = mysqli_num_rows($res); 
                            $sn = 1;
                            if($count > 0){
                                while ($rows=mysqli_fetch_assoc($res)){

                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete Admin</a>
                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                            }
                        }
                    ?>
                </table>
    	        
            </div>
        </div>
<?php include('partials/footer.php'); ?>
