<?php include "components/header.php" ?>

<body>
		
		<!--Navigation-->
   <?php include "components/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                         
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
							<?php
								$query = "SELECT * FROM posts";

								$select_all_posts_query = mysqli_query($connection, $query);

								while($row = mysqli_fetch_assoc($select_all_posts_query)) {
									$posts_title = $row["title"];
									$posts_author = $row["author"];
									$posts_date = $row["date"];
									$posts_image = $row["image"];
									$posts_content = $row["content"];
											
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
									<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <hr>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
							<?php	} ?>
            </div>
            
           

					<!--	Sidebar-->
					<?php include "components/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

 <?php include "components/footer.php" ?>