<?php ob_start();

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "root";
$db['db_name'] = "cms_blog";

foreach($db as $key => $value){
  define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);

$query = "SET NAMES utf8";
mysqli_query($connection,$query);

//if($connection) {
//
//echo "We are connected";
//
//}








?>
