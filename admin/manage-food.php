<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <?php
        // Check whether the session value has or not
        if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }

        // Check whether the session value has or not
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <a class="btn btn-primary" href="<?php echo SITEURL; ?>admin/add-food.php">Add Food</a>
        <br>
        <br>
        <table>
            <tr class="thead">
                <td>#</td>
                <td>Cateogry ID</td>
                <td>Title</td>
                <td>Price</td>
                <td>Image</td>
                <td>Featured</td>
                <td>Active</td>
                <td>Action</td>
            </tr>
            <?php
            // Create SQL query for select all data from databaes tbl_admin tabla
            $sql = "SELECT * FROM tbl_food";
            // Execute the query
            $res = $connection->query($sql);

            // Count the query
            $count = mysqli_num_rows($res);

            // Check whether the value has or not
            if ($count > 0) {
                // Data available
                // Fecth all data 
                $i = 1;
                while ($data = $res->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['category_id']; ?></td>
                        <td><?php echo $data['title']; ?></td>
                        <td><?php echo $data['price']; ?></td>
                        <td>
                            <?php
                            // Check whether the image has or not
                            if ($data['image_name'] != "") {
                            ?>
                                <img style="width: 50px; height: 50px;" src="<?php echo SITEURL; ?>admin/uploads/food/<?php echo $data['image_name'] ?>" alt="">
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($data['featured'] == 'Yes') {
                            ?>
                                <div class="success">Yes</div>
                            <?php
                            } else if ($data['featured'] == 'No') {
                            ?>
                                <div class="error">No</div>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($data['active'] == 'Yes') {
                            ?>
                                <div class="success">Yes</div>
                            <?php
                            } else if ($data['active'] == 'No') {
                            ?>
                                <div class="error">No</div>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="<?php echo SITEURL; ?>admin/edit-category.php?id=<?php echo $data['id']; ?>">Edit Cateogry</a>
                            <a class="btn btn-danger" href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $data['id']; ?>&image_name=<?php echo $data['image_name'] ?>">Delete Category</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="error text-center">Data not found!</td>
                </tr>
            <?php
            }

            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>