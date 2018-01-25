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
						
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Id</th>
									<th>Author</th>
									<th>Title</th>
									<th>Category</th>
									<th>Status</th>
									<th>Image</th>
									<th>Tags</th>
									<th>Comment Count</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								
								<?php 
										$query = "SELECT * FROM posts";
										$select_posts = mysqli_query($connection, $query);

										while($row = mysqli_fetch_assoc($select_posts)) {
											$post_id = $row["id"];
											$post_author = $row["author"];
											$post_title = $row["title"];
											$post_category_id = $row["category_id"];
											$post_status = $row["status"];
											$post_image = $row["image"];
											$post_tags = $row["tags"];
											$post_comment_count = $row["comment_count"];
											$post_date = $row["date"];
											
											echo "<tr>";
											echo "<td>$post_id</td>";
											echo "<td>$post_author</td>";
											echo "<td>$post_title</td>";
											echo "<td>$post_category_id</td>";
											echo "<td>$post_status</td>";
											echo "<td><img class='img-responsive' src='../images/$post_image' alt='post image'></td>";
											echo "<td>$post_tags</td>";
											echo "<td>$post_comment_count</td>";
											echo "<td>$post_date</td>";
											echo "</tr>";

										}?>
							</tbody>
						</table>


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
