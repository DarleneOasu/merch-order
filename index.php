<?php include('partials-front/menu.php') ?>

<section class="merch-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL?>merch-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Merch.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-search">
        </form>
    </div>
</section>


    <?php
    if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Merch</h2>
            <?php
             $sql = "SELECT * FROM tbl_category WHERE featured ='Yes' AND active='Yes' LIMIT 3";

             $res  = mysqli_query($conn, $sql);

             $count = mysqli_num_rows($res);
             $sn = 1;
             if($count > 0){
                 while($row=mysqli_fetch_assoc($res))
                 {
                     $id = $row['id'];
                     $title = $row['title'];
                     $image_name = $row['image_name'];
                     $active = $row['active'];
                ?>
            <a href="<?php echo SITEURL?>category-merch.php?category_id=<?php echo $id?>">
            <div class="box-3 float-container">
                <?php
                    if($image_name == ""){
                        echo "<div class='error'>Image not Avaliable</div>";
                    }else{
                        ?>
                            <img style="width:350px; height: 500px" src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                    }
                ?>
                <h3 class="text-black"><?php echo $title ?></h3>
            </div>
            </a>
            <?php 
                    }
                }else{
                    echo "<div class='error'>Category not added.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- menu Section Starts Here -->
    <section class="merch-menu">
        <div class="container">
            <h2 class="text-center">Merch</h2>

            <?php
             $sql2 = "SELECT * FROM tbl_merch WHERE featured ='Yes' AND active='Yes' LIMIT 6";

             $res2  = mysqli_query($conn, $sql2);

             $count = mysqli_num_rows($res2);
             $sn = 1;
             if($count > 0){
                 while($row=mysqli_fetch_assoc($res2))
                 {
                     $id = $row['id'];
                     $title = $row['title'];
                     $description = $row['description'];
                     $price = $row['price'];
                     $image_name = $row['image_name'];
                     $active = $row['active'];
                 
                ?>
                <div class="merch-menu-box">
                    <div class="merch-menu-img">
                        <?php
                        if($image_name == ""){
                            echo "<div class='error'>Image not Avaliable</div>";
                        }else{
                            ?>
                                <img src="<?php echo SITEURL;?>images/merch/<?php echo $image_name?>" alt="merch" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="merch-menu-desc">
                        <h4><?php echo $title?></h4>
                        <p class="merch-price"><?php echo $price?>€</p>
                        <p class="merch-detail">
                            <?php echo $description?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL?>order.php?merch_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                <?php
                 }
                }else{
                    echo "<div class='error'>Merch not Avaliable.</div>";
                }
                ?>
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php SITEURL?>merch.php">See All Merch</a>
        </p>
    </section>

<?php include('partials-front/footer.php') ?>