<?php include "components/header.php" ?>

<body>
		
<!--Navigation-->
<?php include "components/nav.php" ?>

	<!-- Page Content -->
	<div class="container">

			<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">
			<?php
				// setting number of posts per page
				$per_page = 5;

				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				} else {
					$page = "";
				}

				if ($page  == "" || $page == 1) {
					$page_1 = 0;
				} else {
					$page_1 = ($page * $per_page) - $per_page;
				}

				// Getting the number of posts to determin how many pages we have
				$post_query_count = "SELECT * FROM posts"; 
				$find_count = mysqli_query($connection, $post_query_count);
				$count = mysqli_num_rows($find_count);
				$count = ceil($count / $per_page);
			?>
			<h1 class="page-header">
				All Blog Posts
			</h1>

			<?php
				// getting our posts from the databse and limiting 5 to a page.
				$query = "SELECT * FROM posts LIMIT $page_1, $per_page";

				$select_all_posts_query = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_all_posts_query)) {
					$post_id = $row['post_id'];
					$posts_title = $row["post_title"];
					$posts_author = $row["post_user"];
					$posts_date = $row["post_date"];
					$posts_image = $row["post_image"];
					$posts_content = substr($row["post_content"], 0, 500);
					$posts_status = $row["post_status"];
					
					if($posts_status == "published") {									
					?>
						<!-- Blog Post -->		
						<h2>
							<a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $posts_title?></a>
						</h2>
							<p class="lead">
									by <a href="author_posts.php?author=<?php echo $posts_author?>&p_id=<?php echo $post_id?>"><?php echo $posts_author?></a>
							</p>
							<p><span class="glyphicon glyphicon-time"></span><?php echo $posts_date?></p>
							<hr>
							<a href="post.php?p_id=<?php echo $post_id ?>">
								<img class="img-responsive" src="images/<?php echo $posts_image;?>" alt="">
							</a>
							<hr>
							<p><?php echo $posts_content?></p>
							<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

						<hr>
		<?php	} } ?>
		</div>

		<!--	Sidebar-->
		<?php include "components/sidebar.php" ?>

			</div>
			<!-- /.row -->

			<hr>
			
			<ul class="pager">
				<?php 
					for ($i = 1; $i <= $count; $i++) {
						if ($i == $page) {
							// Displays number of page links based on number of posts
							echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
						} else {
							// Displays number of page links based on number of posts
							echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
						}						
					}
				?>
			</ul>

 <?php include "components/footer.php" ?>
