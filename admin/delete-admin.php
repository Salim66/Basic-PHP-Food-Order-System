<?php
require_once('../app/db.php');
// Check whether the url value has or not
if (isset($_GET['id'])) {
    // Get url value
    $id = $_GET['id'];

    // Create SQL query for deleted admin into database
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    // Execute the query
    $res = $connection->query($sql);

    // Check whether the admin deleted or not
    if ($res == true) {
        // Deleted successfully
        $_SESSION['success'] = '<div class="success">Admin delete successfully ): </div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/manage-admin.php');
        // Stop the process
        die();
    } else {
        // Failed to deleted
        $_SESSION['error'] = '<div class="error">Failed to delete data!</div>';
        // Redirect to page
        header("location:" . SITEURL . 'admin/manage-admin.php');
        // Stop the process
        die();
    }
}
