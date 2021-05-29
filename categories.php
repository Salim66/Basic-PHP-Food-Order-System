<?php require_once('frontend/menu.php') ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php

        // Create SQL query for select all category data
        $sql = "SELECT * FROM tbl_category WHERE featured='Yes'";
        // Execute the query
        $res = $connection->query($sql);
        //count query
        $count = mysqli_num_rows($res);
        //Check whether the data has or not 
        if ($count > 0) {
            // Fetch all data
            while ($data = $res->fetch_assoc()) {
        ?>
                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        // Check whether the image is has or not
                        if (!empty($data['image_name'])) {
                        ?>
                            <img src="<?php echo SITEURL; ?>admin/uploads/category/<?php echo $data['image_name'] ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $data['image_name'] ?></h3>
                    </div>
                </a>
        <?php
            }
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php require_once('frontend/footer.php') ?>