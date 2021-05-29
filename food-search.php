<?php require_once('frontend/menu.php') ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on Your Search <a href="#" class="text-white">"Momo"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php

        // Check whether the id has or not
        if (isset($_GET['id'])) {
            // Get value from form
            $id = $_GET['id'];
        }

        //1. Create SQL query all data select food table in databse 
        $sql = "SELECT * FROM tbl_food WHERE id=$id";
        //2. Execute the query
        $res = $connection->query($sql);

        //3. Count the data because data is has or not
        $count = mysqli_num_rows($res);

        //4. Check whether the value has or not
        if ($count > 0) {
            // Data is available
            // GEt all data and fetch
            while ($data = $res->fetch_assoc()) {
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Check whether image has or not
                        if ($data['image_name'] == '') {
                            //Display the message
                        ?>
                            <div style="color: #ff4757; text-align: center;">Image is not available!</div>
                        <?php
                        } else {
                            //Display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>admin/uploads/food/<?php echo $data['image_name'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                        }

                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $data['title'] ?></h4>
                        <p class="food-price">$<?php echo $data['price'] ?></p>
                        <p class="food-detail">
                            <?php echo $data['description'] ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $data['id'] ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            <?php
            }
        } else {
            // Data is not available
            ?>
            <div class="color: #ff4757; text-align: center;">Data not found!</div>
        <?php
        }


        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php require_once('frontend/footer.php') ?>