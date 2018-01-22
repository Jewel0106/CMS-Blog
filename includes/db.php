<?php 

$connection = mysqli_connect('localhost', 'root', 'root', 'cms_blog');

if($connection) {
	echo "We are connected";
}

?>