<?php
// Server connection 
require_once('../app/db.php');

// Chcek the rul value has or not
if (isset($_GET['id'])) {
    // Get url value
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Image unlink/remove to physical folder
    if (file_exists('uploads/food/' . $image_name) && !empty($image_name)) {
        // Ready to Unlink image
        $remove = unlink('uploads/food/' . $image_name);

        // Check whether the physical image remove or not
        if ($remove == false) {
            // Failed to image remove
            // Set message into session
            $_SESSION['error'] = '<div class="error">Failed to image remove!</div>';
            // Redirect to page
            header("location:" . SITEURL . 'admin/manage-food.php');
            // Stop to process
            die();
        }
    }

    // Create SQL query for food deleted
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // Execute the query
    $res = $connection->query($sql);

    // Check whether the food deleted or not
    if ($res == true) {
        // Deleted successfully 
        // Set message into session
        $_SESSION['success'] = '<div class="success">Food deleted successfully ): </div>';
        // Redirect ot page
        header('location:' . SITEURL . 'admin/manage-food.php');
        // Stop top process
        die();
    } else {
        // Failed to delete food
        // Set message into session
        $_SESSION['error'] = '<div class="error">Failed to delete food!</div>';
        // Redirect ot page
        header('location:' . SITEURL . 'admin/manage-food.php');
        // Stop top process
        die();
    }
}
