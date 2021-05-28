<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
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
        <br>
        <table>
            <tr class="thead">
                <td>#</td>
                <td>Title</td>
                <td>Image</td>
                <td>Featured</td>
                <td>Active</td>
                <td>Active</td>
            </tr>
            <?php
            // Create SQL query for select all data from databaes tbl_admin tabla
            $sql = "SELECT * FROM tbl_category";
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
                        <td><?php echo $data['title']; ?></td>
                        <td>
                            <?php
                            // Check whether the image has or not
                            if ($data['image_name'] != "") {
                            ?>
                                <img style="width: 50px; height: 50px;" src="<?php echo SITEURL; ?>admin/uploads/category/<?php echo $data['image_name'] ?>" alt="">
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
                            <a class="btn btn-info" href="<?php echo SITEURL; ?>admin/edit-admin.php?id=<?php echo $data['id']; ?>">Edit Admin</a>
                            <a class="btn btn-danger" href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $data['id']; ?>">Delete Admin</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="error">Data not found!</td>
                </tr>
            <?php
            }

            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>