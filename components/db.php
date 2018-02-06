<?php

//Create variables for our sql connection
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "root";
$db['db_name'] = "cms_blog";

// We loop through each key in our $db variable and create a constant
foreach($db as $key => $value) {
	define(strtoupper($key), $value);
}

// inter our constant variables into our connection function
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// $query = "SET NAMES utf8";
// mysqli_query($connection,$query);
?>
