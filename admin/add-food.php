<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <?php
        // Check whether the session value has or not
        if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }

        ?>
        <br>
        <a class="btn btn-primary" href="<?php echo SITEURL; ?>admin/manage-food.php">List Food</a>
        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Cateogry Name</label>
                <select name="category_id" id="category_id" class="form-control">
                    <?php
                    // Create SQL query all category seelcted
                    $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes'";
                    // Execute the query
                    $res = $connection->query($sql);
                    // Count the query
                    $count = mysqli_num_rows($res);
                    // Check whether the data has or not
                    if ($count > 0) {
                        // Data available 
                        // Fetch all data
                        while ($data = $res->fetch_assoc()) {
                    ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></option>
                        <?php
                        }
                    } else {
                        ?>
                        <option value="0">Category not found</option>
                    <?php
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="image_name">
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="description" style="width: 420px;" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="">Featured</label>
                <input type="radio" name="featured" id="f_yes" value="Yes"><label style="display: inline;" for="f_yes">Yes</label>
                <input type="radio" name="featured" id="f_no" value="No"><label style="display: inline;" for="f_no">No</label>
            </div>
            <div class="form-group">
                <label for="">Active</label>
                <input type="radio" name="active" id="a_yes" value="Yes"><label style="display: inline;" for="a_yes">Yes</label>
                <input type="radio" name="active" id="a_no" value="No"><label style="display: inline;" for="a_no">No</label>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Add new">
            </div>
        </form>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>

<?php
// Chcek whether the submit button press or not
if (isset($_POST['submit'])) {
    // Get all the value from form
    $category_id = $_POST['category_id'];
    $title       = $_POST['title'];
    $price       = $_POST['price'];
    $description = $_POST['description'];
    $featured    = $_POST['featured'];
    $active      = $_POST['active'];

    // Image upload
    if (isset($_FILES['image_name']['name'])) {
        // Get image name and tmp/source path
        $image = $_FILES['image_name']['name'];
        $source_path = $_FILES['image_name']['tmp_name'];
        // Find image extension
        $array = explode('.', $image);
        $extension = end($array);
        // genarate image unique name
        $image_unique_name = "food-image-" . rand(000, 999) . '.' . $extension;

        // Extecpted file extension
        $excepted_extension = ['jpg', 'jpeg', 'png', 'gif'];

        // Check whether the extension has or not
        if (in_array($extension, $excepted_extension)) {
            // Finally move image into folder
            $upload = move_uploaded_file($source_path, 'uploads/food/' . $image_unique_name);

            // Check whether the image uploaded or not
            if ($upload == false) {
                // Failed to upload image
                // Set message into session
                $_SESSION['error'] = '<div class="error">Failed to image uploaded!</div>';
                // Redirect to page
                header("location:" . SITEURL . 'admin/add-food.php');
                // Stop to process
                die();
            }
        }
    }

    // Check whether the all fields are required
    if ($title != "" && $featured != "" && $active != "" && $category_id != "" && $price != "") {
        // Create SQL query for insert data into database
        $sql = "INSERT INTO tbl_food (category_id, title, image_name, description, price, featured, active) VALUES ('$category_id', '$title', '$image_unique_name', '$description', '$price', '$featured', '$active')";
        // Execute the query
        $res = $connection->query($sql);

        // Check whether the database data insert or not
        if ($res == true) {
            // Data inserted
            // Set message into session
            $_SESSION['error'] = '<div class="success">Data added successfully ): </div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/manage-food.php');
            // Stop the process
            die();
        } else {
            // Failed to data inserted
            // Set message into session 
            $_SESSION['error'] = '<div class="error">Failed to data added!</div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/add-food.php');
            // Stop to process
            die();
        }
    } else {
        // Set message into session 
        $_SESSION['error'] = '<div class="error">Please field all the fill!</div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/add-food.php');
        // Stop to process
        die();
    }
}


?>