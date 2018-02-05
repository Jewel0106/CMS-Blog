<?php include "components/header.php" ?>

<body>
	
 <?php include "components/nav.php" ?><!--Navigation-->
	
	<div class="container"><!-- Page Content -->
		<div class="row">		
			<div class="col-md-8"><!-- Blog Entries Column -->

			 <?php          
				if(isset($_GET['p_id'])) {
          $post_id = $_GET['p_id'];
          $post_author = $_GET['author'];
				 }

        $query = "SELECT * FROM posts WHERE post_user = '{$post_author}' ";

				$select_all_posts_query = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_all_posts_query)) {
					$posts_title = $row["post_title"];
					$posts_author = $row["post_user"];
					$posts_date = $row["post_date"];
					$posts_image = $row["post_image"];
					$posts_content = $row["post_content"];										
				?>

					<!-- Blog Post -->
					<h2>
							<a href="#"><?php echo $posts_title?></a>
					</h2>
						<p class="lead">
								All posts by <?php echo $posts_author?>
						</p>
						<p><span class="glyphicon glyphicon-time"></span><?php echo $posts_date?></p>
						<hr>
						<img class="img-responsive" src="images/<?php echo $posts_image;?>" alt="">
						<hr>
						<p><?php echo $posts_content?></p>

					<hr>
				<?php	} ?>

					<!-- Blog Comments -->
					<?php 
					if(isset($_POST['create_comment'])) {
						$post_id = $_GET['p_id'];								

						$comment_author = $_POST['comment_author'];
						$comment_email = $_POST['comment_email'];
						$comment_content = $_POST['comment_content'];

						if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

							$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";
							$query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved',now())";
	
							$create_comment_query = mysqli_query($connection, $query);
	
							if(!$create_comment_query) {
								die("Query failed" . mysqli_error($connection));
							}
							
							$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id ";
							$update_comment_count = mysqli_query($connection, $query);
						} else {
							echo "<script> alert('Fields cannot be empty')</script>";
						}


					}
					?>					

			</div>

			<!--	Sidebar-->
			<?php include "components/sidebar.php" ?>

		</div><!-- /.row -->

			<hr>

 <?php include "components/footer.php" ?> <!-- Footer-->
