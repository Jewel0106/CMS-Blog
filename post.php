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
							if(isset($_GET['p_id'])) {
								$post_id = $_GET['p_id'];
               }


								$query = "SELECT * FROM posts WHERE post_id= $post_id";

								$select_all_posts_query = mysqli_query($connection, $query);

								while($row = mysqli_fetch_assoc($select_all_posts_query)) {
									$posts_title = $row["post_title"];
									$posts_author = $row["post_author"];
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
									<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <hr>

							<?php	} ?>
           
           
								<!-- Blog Comments -->

								<!-- Comments Form -->
								<div class="well">
										<h4>Leave a Comment:</h4>
										<form role="form">
												<div class="form-group">
														<textarea class="form-control" rows="3"></textarea>
												</div>
												<button type="submit" class="btn btn-primary">Submit</button>
										</form>
								</div>

								<hr>

								<!-- Posted Comments -->

								<!-- Comment -->
								<div class="media">
										<a class="pull-left" href="#">
												<img class="media-object" src="http://placehold.it/64x64" alt="">
										</a>
										<div class="media-body">
												<h4 class="media-heading">Start Bootstrap
														<small>August 25, 2014 at 9:30 PM</small>
												</h4>
												Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
										</div>
								</div>

								<!-- Comment -->
								<div class="media">
										<a class="pull-left" href="#">
												<img class="media-object" src="http://placehold.it/64x64" alt="">
										</a>
										<div class="media-body">
												<h4 class="media-heading">Start Bootstrap
														<small>August 25, 2014 at 9:30 PM</small>
												</h4>
												Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
												<!-- Nested Comment -->
												<div class="media">
														<a class="pull-left" href="#">
																<img class="media-object" src="http://placehold.it/64x64" alt="">
														</a>
														<div class="media-body">
																<h4 class="media-heading">Nested Start Bootstrap
																		<small>August 25, 2014 at 9:30 PM</small>
																</h4>
																Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
														</div>
												</div>
												<!-- End Nested Comment -->
										</div>
								</div>
            </div>
            
           

					<!--	Sidebar-->
					<?php include "components/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

 <?php include "components/footer.php" ?>