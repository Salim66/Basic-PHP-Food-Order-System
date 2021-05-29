<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<?php

// Check whether the url value has or not
if (isset($_GET['id'])) {
    // Get value from url
    $id = $_GET['id'];

    // Create SQL query for select specific category
    $sql = "SELECT * FROM tbl_category WHERE id=$id";
    // Execute the query
    $res = $connection->query($sql);

    // Count the query 
    $count = mysqli_num_rows($res);
    // Check whether the value has or not
    if ($count > 0) {
        // Data is available
        // Fetch selected data
        $data = $res->fetch_assoc();
    }
}

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Edit Category</h1>
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
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <input type="text" name="title" class="form-control" value="<?php echo $data['title'] ?>">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <div>
                    <label for="">Old Image</label>
                    <img style="width: 100px; height: 100px;" src="<?php echo SITEURL; ?>admin/uploads/category/<?php echo $data['image_name']; ?>" alt="">
                    <input type="hidden" name="old_image" value="<?php echo $data['image_name'] ?>">
                </div>
                <input type="file" name="image_name">
            </div>
            <div class="form-group">
                <label for="">Featured</label>
                <input <?php if ($data['featured'] == 'Yes') echo 'checked'; ?> type="radio" name="featured" id="f_yes" value="Yes"><label style="display: inline;" for="f_yes">Yes</label>
                <input <?php if ($data['featured'] == 'No') echo 'checked'; ?> type="radio" name="featured" id="f_no" value="No"><label style="display: inline;" for="f_no">No</label>
            </div>
            <div class="form-group">
                <label for="">Active</label>
                <input <?php if ($data['active'] == 'Yes') echo 'checked'; ?> type="radio" name="active" id="a_yes" value="Yes"><label style="display: inline;" for="a_yes">Yes</label>
                <input <?php if ($data['active'] == 'No') echo 'checked'; ?> type="radio" name="active" id="a_no" value="No"><label style="display: inline;" for="a_no">No</label>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
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
    $id        = $_POST['id'];
    $title     = $_POST['title'];
    $featured  = $_POST['featured'];
    $active    = $_POST['active'];
    echo $old_image = $_POST['old_image'];

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
                header("location:" . SITEURL . 'admin/edit-category.php');
                // Stop to process
                die();
            }
        }
        // Check whether the image has or not
        // Image unlink/remove to physical folder
        if (file_exists('uploads/category/' . $old_image) && !empty($old_image)) {
            // Ready to Unlink image
            $remove = unlink('uploads/category/' . $old_image);

            // Check whether the physical image remove or not
            if ($remove == false) {
                // Failed to image remove
                // Set message into session
                $_SESSION['error'] = '<div class="error">Failed to image remoev!</div>';
                // Redirect to page
                header("location:" . SITEURL . 'admin/manage-category.php');
                // Stop to process
                die();
            }
        }
    } else {
        $image_unique_name = $old_image;
    }

    // Check whether the all fields are required
    if ($title != "" && $featured != "" && $active != "") {
        // Create SQL query for insert data into database
        $sql = "UPDATE tbl_category SET title='$title', image_name='$image_unique_name', featured='$featured', active='$active' WHERE id=$id";
        // Execute the query
        $res = $connection->query($sql);

        // Check whether the database data insert or not
        if ($res == true) {
            // Data inserted
            // Set message into session
            $_SESSION['error'] = '<div class="success">Data updated successfully ): </div>';
            // Redirect to page
            echo ("<script>location.href='" . SITEURL . "admin/manage-category.php'</script>");
            // Stop the process
            die();
        } else {
            // Failed to data inserted
            // Set message into session 
            $_SESSION['error'] = '<div class="error">Failed to data updated!</div>';
            // Redirect to page
            echo ("<script>location.href='" . SITEURL . "admin/edit-category.php'</script>");
            // Stop to process
            die();
        }
    } else {
        // Set message into session 
        $_SESSION['error'] = '<div class="error">Please field all the fill!</div>';
        // Redirect to page
        echo ("<script>location.href='" . SITEURL . "admin/edit-category.php'</script>");
        // Stop to process
        die();
    }
}


?>