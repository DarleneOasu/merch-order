<?php include('partials-front/menu.php') ?>

    <section class="merch-search text-center">
        <div class="mlur">

            <div class="container">
            <?php

            $search = $_POST['search'];
            ?>
                
                <h2 class="text-white">You have searched: <a href="#" class="text-grey">"<?php echo $search?>"</a></h2>

            </div>
        </div>
    </section>


    <section class="merch-menu">
        <div class="container">
            <h2 class="text-center">Merch Menu</h2>
            <?php
             $sql = "SELECT * FROM tbl_merch WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

             $res  = mysqli_query($conn, $sql);

             $count = mysqli_num_rows($res);

            if($count > 0){
                 while($row=mysqli_fetch_assoc($res))
                {
                     $id = $row['id'];
                     $title = $row['title'];
                     $description = $row['description'];
                     $price = $row['price'];
                     $image_name = $row['image_name'];
                }
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
            }else{
                echo "<div class='error'>Merch not Avaliable.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- merch Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>