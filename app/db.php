<?php


// create constant for server information
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWRD', '');
define('DBNAME', 'basic_php_food_order');

//Connection to server
$connection = new mysqli(HOST, USERNAME, PASSWRD, DBNAME);
