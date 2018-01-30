
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
								Welcome to Admin
								<small>Author</small>
						</h1>
						
						<?php
						if(isset($_GET['source'])) {
							$source = $_GET['source'];
						} else {
							$source = '';
						}
						
						switch($source) {
								case "add_user";
									include "components/add_user.php";
								break;
								case "edit_user";
									include "components/edit_user.php";
								break;
							default:
								include "components/view_all_users.php";
							break;
						}
						?>

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