<?php require_once('layout/menu.php') ?>

<?php
// Check whether the url value set or not
if (isset($_GET['id'])) {
    // Get the url value
    $id = $_GET['id'];

    // Create SQL query for select single admin data
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    // Execute the query
    $res = $connection->query($sql);

    // Count the query data
    $count = mysqli_num_rows($res);

    // Check whether the $count variable data has or not
    if ($count > 0) {
        // Data Available
        $data = $res->fetch_assoc();
    } else {
        // Data not available
        // Message set into session
        $_SESSION['error'] = '<div class="error">Data not available!</div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/manage-admin.php');
        // Stop the process
    }
}


?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Edit Admin</h1><br>
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
        <a class="btn btn-primary" href="<?php echo SITEURL; ?>admin/manage-admin.php">List Admin</a>
        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?php echo $data['full_name'] ?>">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $data['username'] ?>">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>

<!-- Add admin SQL -->
<?php

// Check whether the submit button press or not 
if (isset($_POST['submit'])) {
    // Get all values from form
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];

    // Check whether the all values enter or not
    if ($full_name != "" && $username != "" && $password != "") {
        // Process next step
        // Create SQL query for inset admin data into database
        $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES('$full_name', '$username', '$password')";
        // Execute the query
        $res = $connection->query($sql);

        // Check whether the values insert or not into database
        if ($res == true) {
            // Success
            // Set message into session 
            $_SESSION['success'] = '<div class="success">Admin added successfully ): </div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/manage-admin.php');
            // Stop the process
            die();
        } else {
            // Failed
            // Set message into session 
            $_SESSION['error'] = '<div class="error">Failed to added data! </div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/add-admin.php');
            // Stop the process
            die();
        }
    } else {
        // Stop the process
        $_SESSION['error'] = '<div class="error">Please filled all the fill!</div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/add-admin.php');
        // Stop the process
        die();
    }
}



?>