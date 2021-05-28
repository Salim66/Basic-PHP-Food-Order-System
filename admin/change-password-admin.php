<?php require_once('layout/menu.php') ?>

<?php
// Check whether the url value set or not
if (isset($_GET['id'])) {
    // Get url value
    $id = $_GET['id'];
}

?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Admin Change Password</h1><br>
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
                <label for="">Old Password</label>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="password" name="old_password" class="form-control">
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" name="new_password" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
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
    $id                = $_POST['id'];
    $old_password      = md5($_POST['old_password']);
    $new_password      = md5($_POST['new_password']);
    $confirm_password  = md5($_POST['confirm_password']);

    // Check whether the all values enter or not
    if ($old_password != "" && $new_password != "" && $confirm_password != "") {
        // Process next step
        // Check admin password match or not 
        $sql1 = "SELECT * FROM tbl_admin WHERE password='$old_password'";
        $res1 = $connection->query($sql1);
        $count = mysqli_num_rows($res1);
        if ($count > 0) {
            // Check new password and confirm password match or not
            if ($new_password == $confirm_password) {
                // Create SQL query for change password into database
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                // Execute the query
                $res2 = $connection->query($sql2);

                // Check whether the values updated or not into database
                if ($res2 == true) {
                    // Success
                    // Set message into session 
                    $_SESSION['success'] = '<div class="success">Change password successfully ): </div>';
                    // Redirect to page
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                    // Stop the process
                    die();
                } else {
                    // Failed
                    // Set message into session 
                    $_SESSION['error'] = '<div class="error">Failed to chanage password! </div>';
                    // Redirect to page
                    header("location:" . SITEURL . 'admin/change-password-admin.php');
                    // Stop the process
                    die();
                }
            } else {
                // Password not match
                // Set message into session
                $_SESSION['error'] = '<div class="error">New password and Confirm password did not match!</div>';
                // Redirect to page
                header("location:" . SITEURL . 'admin/change-password-admin.php');
                // Stop the process
                die();
            }
        } else {
            // Password not match
            // Set message into session
            $_SESSION['error'] = '<div class="error">Your current password did not match!</div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/change-password-admin.php');
            // Stop the process
            die();
        }
    } else {
        // Set message into session
        $_SESSION['error'] = '<div class="error">Please filled all the fill!</div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/change-password-admin.php');
        // Stop the process
        die();
    }
}



?>