<?php

function usersOnline() {

	if(isset($_GET['onlineusers'])) {
		global $connection;

		if(!$connection) {
			session_start();
			include("../components/db.php");

			// Checking for online users
			$session = session_id();

			$time = time();
			$timeout_in_seconds = 30;
			$timeout = $time - $timeout_in_seconds;

			$query = "SELECT * FROM users_online WHERE session = '$session'";
			$send_query = mysqli_query($connection, $query);
			$count = mysqli_num_rows($send_query);

			if ($count == NULL) {
				mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
			} else {
				mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
			}

			$users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time < '$timeout' ");
			echo $count_user = mysqli_num_rows($users_online_query);
		}	
	}
}

usersOnline();

// ADD NEW CATEGORY FUNCTION
function insertCategories() { 
	global $connection;
	if(isset($_POST['submit'])) {
		$cat_title = $_POST['cat_title'];

			if($cat_title === "" || empty($cat_title)) {
				echo "Please fill out this field.";
			} else {
				$query = "INSERT INTO categories(cat_title) ";
				$query .= "VALUE('{$cat_title}') ";

				$create_category_query = mysqli_query($connection, $query);

				if(!$create_category_query) {
					die("Query Failed" . mysqli_error($connection));
				}
			}
	} 
}

// FIND AND DISPLAY CATEGORY FUNCTION
function findAllCategories() {
	global $connection;
	
	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);

	while($row = mysqli_fetch_assoc($select_categories)) {
		$category_id = $row["cat_id"];
		$category_title = $row["cat_title"];

		echo "<tr>";
		echo "<td>{$category_id}</td>";
		echo "<td>{$category_title}</td>";
		echo "<td><a href='categories.php?delete={$category_id}'>Delete</a>";
		echo "<td><a href='categories.php?edit={$category_id}'>Edit</a></td>";
		echo "</tr>";
	}
}

// DELETE CATEGORY FUNCTION
function deleteCategories() {
	global $connection;
	if(isset($_GET['delete'])) {
		$cat_id_delete = $_GET['delete'];

			$query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete} ";
			$deleteQuery = mysqli_query($connection, $query);
			// Refeshes the page
			header("Location: categories.php");
	}					
}

// Confirm Query Function
function confirmQuery($result) {
	global $connection;
	
	if(!$result) {
		die("Query Failed" . mysqli_error($connection));
	}
}

?>
