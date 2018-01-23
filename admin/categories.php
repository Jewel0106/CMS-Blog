<?php include "components/admin_header.php"?>

<body>

    <div id="wrapper">
			
			<!-- Navigation-->
      <?php include "components/admin_nav.php"?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin Page
                            <small>Author Name</small>
                        </h1>
                        
                        <div class="col-xs-6">
                        
<?php 
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
?>
                        	<form action="" method="post">
                        		<div class="form-group">
                        		<label for="cat_title">Add Category</label>
                        			<input class="form-control" type="text" name="cat_title">
                        		</div>
                        		<div class="form-group">
                        			<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        		</div>
                        	</form>
                        </div> 
                        
                        <div class="col-xs-6">
<?php 
	$query = "SELECT * FROM categories";

	$select_categories = mysqli_query($connection, $query);
?>
                        	<table class="table table-bordered table-hover">
                        		<thead>
                        			<tr>
                        				<th>Category Title</th>
                        				<th>ID</th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        		
<?php 
while($row = mysqli_fetch_assoc($select_categories)) {
	$category_id = $row["id"];
	$category_title = $row["title"];

	echo "<tr>";
	echo "<td>{$category_id}</td>";
	echo "<td>{$category_title}</td>";
	echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td></tr>";
}?>
                        		
<?php
	if(isset($_GET['delete'])) {
		$cat_id_delete = $_GET['delete'];
		
			$query = "DELETE FROM categories WHERE id = {$cat_id_delete} ";
			$deleteQuery = mysqli_query($connection, $query);
			// Refeshes the page
			header("Location: categories.php");
	}															
?>

                        		</tbody>
                        	</table>
                        </div> 

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
<?php include "components/admin_footer.php"?>
