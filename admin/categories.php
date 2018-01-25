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

							<?php insertCategories();?>

							<form action="" method="post">
								<div class="form-group">
								<label for="cat_title">Add Category</label>
									<input class="form-control" type="text" name="cat_title">
								</div>
								<div class="form-group">
									<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
								</div>
							</form>

							<?php // UPDATE and INCLUDE query 
							if (isset($_GET['edit'])) {
								$cat_id = $_GET['edit'];
								include "components/update_categories.php";
							} ?>
						</div> 

						<div class="col-xs-6">

							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Category Title</th>
										<th>ID</th>
									</tr>
								</thead>
								<tbody>
									<?php findAllCategories(); ?>

									<?php deleteCategories(); ?>
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
