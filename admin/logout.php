<?php
// Connection server
require_once('../app/db.php');

session_start();
session_destroy();
// Redirect ot page
header('location:' . SITEURL . 'admin/login.php');
// Stop the process 
die();
