<?php

// Check whether the admin login or not
if (!isset($_SESSION['username'])) {
    // Set message into session 
    $_SESSION['error'] = '<div class="error">Admin panel did not permission without login. Please login first!</div>';
    // Redirect to page
    header('location:' . SITEURL . 'admin/login.php');
    // Stop the process
    die();
}
