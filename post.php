<?php include "components/header.php" ?>

<body>
	
 <?php include "components/nav.php" ?><!--Navigation-->
	
	<div class="container"><!-- Page Content -->
		<div class="row">		
			<div class="col-md-8"><!-- Blog Entries Column -->

			 <?php          
				if(isset($_GET['p_id'])) {
					$post_id = $_GET['p_id'];

					$view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id ";
					$send_query = mysqli_query($connection, $view_query);
				 
					if(!$send_query) {
						die("Query failed" . mysqli_error($connection));
					}

					$query = "SELECT * FROM posts WHERE post_id= $post_id";
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
								by <a href="index.php"><?php echo $posts_author?></a>
						</p>
						<p><span class="glyphicon glyphicon-time"></span><?php echo $posts_date?></p>
						<hr>
						<img class="img-responsive" src="images/<?php echo $posts_image;?>" alt="">
						<hr>
						<p><?php echo $posts_content?></p>

					<hr>
				<?php	} 
			
			} else {
				header("Location: index.php");
			} ?>

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

						} else {
							echo "<script> alert('Fields cannot be empty')</script>";
						}


					}
					?>

					<!-- Comments Form -->
					<div class="well">
							<h4>Leave a Comment:</h4>
							<form action="" method="post" role="form">
									<div class="form-group">
											<label for="author">Author</label>
											<input type="text" name="comment_author" class="form-control" name="comment_author">
									</div>
									<div class="form-group">
											<label for="email">Email</label>
											<input type="text" name="comment_email" class="form-control" name="comment_email">
									</div>
									<div class="form-group">
											<label for="comment">Your Comment</label>
											<textarea name="comment_content" class="form-control" rows="3"></textarea>
									</div>
									<button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
							</form>
					</div>

					<hr>

					<!-- Posted Comments -->
					<?php
					$query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
					$query .="AND comment_status = 'approved' ";
					$query .="ORDER BY comment_id DESC ";
					
					$select_comment_query = mysqli_query($connection, $query);
				
					if(!$select_comment_query) {
						die("Query Failed" . mysqli_error($connection));
					}
				
					while($row = mysqli_fetch_assoc($select_comment_query)) {
						$comment_date = $row['comment_date'];
						$comment_content = $row['comment_content'];
						$comment_author = $row['comment_author'];
					?>
						<!--	Comment-->
						<div class="media">
								<a class="pull-left" href="#">
										<img class="media-object" src="http://placehold.it/64x64" alt="">
								</a>
								<div class="media-body">
										<h4 class="media-heading"><?php echo $comment_author; ?>
												<small><?php echo $comment_date; ?></small>
										</h4>
										<?php echo $comment_content; ?>
								</div>
						</div>						
				
		<?php } ?>

			</div>

			<!--	Sidebar-->
			<?php include "components/sidebar.php" ?>

		</div><!-- /.row -->

			<hr>

 <?php include "components/footer.php" ?> <!-- Footer-->
