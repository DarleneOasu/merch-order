<?php include('partials-front/menu.php') ?>

    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Mearch.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
             $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

             $res  = mysqli_query($conn, $sql);

             $count = mysqli_num_rows($res);
             $sn = 1;
             if($count > 0){
                 while($row=mysqli_fetch_assoc($res))
                 {
                     $id = $row['id'];
                     $title = $row['title'];
                     $description = $row['description'];
                     $price = $row['price'];
                     $image_name = $row['image_name'];
                     $active = $row['active'];
                 }
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if($image_name == ""){
                            echo "<div class='error'>Image not Avaliable</div>";
                        }else{
                            ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="food" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title?></h4>
                        <p class="food-price"><?php echo $price?>€</p>
                        <p class="food-detail">
                            <?php echo $description?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                <?php
                }else{
                    echo "<div class='error'>Merch not Avaliable.</div>";
                }
                ?>

            <div class="clearfix"></div>
        </div>
    </section>

<?php include('partials-front/footer.php') ?>