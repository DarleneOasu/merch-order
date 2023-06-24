<?php include('partials-front/menu.php') ?>
<?php
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql ="SELECT title FROM tbl_category WHERE id = $category_id";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];
    }else{
        header('location:'.SITEURL);
    }
?>
    <section class="merch-search text-center">
    <div class="mlur">

        <div class="container">
            
            <h2>Merch on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

        </div>
    </div>
    </section>

    <section class="merch-menu">
        <div class="container">
            <h2 class="text-center">Merch Menu</h2>

            <?php 
            $sql2 ="SELECT * FROM tbl_merch WHERE category_id = $category_id";
            $res2 = mysqli_query($conn, $sql2);
    
            $count2 = mysqli_num_rows($res2);
            if($count2 > 0){
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
                    $active = $row2['active'];
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

    </section>
    <!-- merch Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>