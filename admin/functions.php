<?php

// ADD NEW CATEGORY FUNCTION
function insertCategories() { 
	global $connection;
	if(isset($_POST['submit'])) {
		$cat_title = $_POST['cat_title'];

			if($cat_title === "" || empty($cat_title)) {
				echo "Please fill out this field.";
			} else {
				$query = "INSERT INTO categories(title) ";
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
		$category_id = $row["id"];
		$category_title = $row["title"];

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

			$query = "DELETE FROM categories WHERE id = {$cat_id_delete} ";
			$deleteQuery = mysqli_query($connection, $query);
			// Refeshes the page
			header("Location: categories.php");
	}					
}

?>