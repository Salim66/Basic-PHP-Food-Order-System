<?php
// session start
session_start();

// create constant for server information]
define("SITEURL", 'http://localhost/basic-php-food-order/');
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWRD', '');
define('DBNAME', 'basic_php_food_order');

//Connection to server
$connection = new mysqli(HOST, USERNAME, PASSWRD, DBNAME);
