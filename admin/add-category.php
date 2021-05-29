<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
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
        <a class="btn btn-primary" href="<?php echo SITEURL; ?>admin/manage-category.php">List Category</a>
        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="image_name">
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
    $title    = $_POST['title'];
    $featured = $_POST['featured'];
    $active   = $_POST['active'];

    // Image upload
    if (isset($_FILES['image_name']['name'])) {
        // Get image name and tmp/source path
        $image = $_FILES['image_name']['name'];
        $source_path = $_FILES['image_name']['tmp_name'];
        // Find image extension
        $array = explode('.', $image);
        $extension = end($array);
        // genarate image unique name
        $image_unique_name = "category-image-" . rand(000, 999) . '.' . $extension;

        // Extecpted file extension
        $excepted_extension = ['jpg', 'jpeg', 'png', 'gif'];

        // Check whether the extension has or not
        if (in_array($extension, $excepted_extension)) {
            // Finally move image into folder
            $upload = move_uploaded_file($source_path, 'uploads/category/' . $image_unique_name);

            // Check whether the image uploaded or not
            if ($upload == false) {
                // Failed to upload image
                // Set message into session
                $_SESSION['error'] = '<div class="error">Failed to image uploaded!</div>';
                // Redirect to page
                header("location:" . SITEURL . 'admin/add-category.php');
                // Stop to process
                die();
            }
        }
    }

    // Check whether the all fields are required
    if ($title != "" && $featured != "" && $active != "") {
        // Create SQL query for insert data into database
        $sql = "INSERT INTO tbl_category (title, image_name, featured, active) VALUES ('$title', '$image_unique_name', '$featured', '$active')";
        // Execute the query
        $res = $connection->query($sql);

        // Check whether the database data insert or not
        if ($res == true) {
            // Data inserted
            // Set message into session
            $_SESSION['error'] = '<div class="success">Data added successfully ): </div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/manage-category.php');
            // Stop the process
            die();
        } else {
            // Failed to data inserted
            // Set message into session 
            $_SESSION['error'] = '<div class="error">Failed to data added!</div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/add-category.php');
            // Stop to process
            die();
        }
    } else {
        // Set message into session 
        $_SESSION['error'] = '<div class="error">Please field all the fill!</div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/add-category.php');
        // Stop to process
        die();
    }
}


?>