
<?php  
if(isset($_POST['checkBoxArray'])) {
	
 foreach($_POST['checkBoxArray'] as $postValueId ) {
	$bulk_options = $_POST['bulk_options'];
	 
	switch($bulk_options) {
		case 'published':
			$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
			
			$update_to_publish = mysqli_query($connection, $query);
			
			confirmQuery($update_to_publish);
			
			echo "<p class='bg-success'>Post Published</p>";
						
		break;
		case 'draft':
			$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
			
			$update_to_draft = mysqli_query($connection, $query);
			
			confirmQuery($update_to_draft);
			
			echo "<p class='bg-success'>Post set as draft</p>";
		break;
		case 'delete':
			$query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
			
			$delete_posts = mysqli_query($connection, $query);
			
			confirmQuery($delete_posts);
			
			echo "<p class='bg-danger'>Post Deleted</p>";
		break;
		case 'clone':
			$query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
			$select_posts_query = mysqli_query($connection, $query);
			
			while ($row = mysqli_fetch_array($select_posts_query)) {
				$post_title 			= $row['post_title'];
				$post_author 			= $row['post_author'];
				$post_category_id = $row['post_category_id'];
				$post_status 			= $row['post_status'];				
				$post_image 			= $row['post_image'];
				$post_tags 				= $row['post_tags'];
				$post_content 		= $row['post_content'];
				$post_date 				= $row['post_date'];
			}

			$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
			$query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}',now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

			$clone_query = mysqli_query($connection, $query);
	
			confirmQuery($clone_query);
			
			echo "<p class='bg-success'>Post Cloned</p>";
		break;
		case 'reset':
			$query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$postValueId} ";
			
			$reset_posts = mysqli_query($connection, $query);
			
			confirmQuery($reset_posts);
			
			echo "<p class='bg-danger'>Views Reset</p>";

			
		$reset_query = mysqli_query($connection, $query);
		break;
	}
 }
}
?>

<form action='' method='post'>
	<table class="table table-bordered table-hover">
		
		<div id="bulkOptionsContainer" class="col-xs-4">
			<select class="form-control" name="bulk_options" id="">
				<option value="">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				<option value="delete">Delete</option>
				<option value="clone">Clone</option>
				<option value="reset">Reset Views</option>
			</select>
		</div>
		
		<div class="col-xs-4">
			<input type="submit" name="submit" class="btn btn-success" value="Apply">
			<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
		</div>
		
		<thead>
			<tr>
				<th><input type="checkbox" id="selectAllBoxes"></th>
				<th>Id</th>
				<th>Author</th>
				<th>Title</th>
				<th>Category</th>
				<th>Status</th>
				<th>Image</th>
				<th>Tags</th>
				<th>Comment Count</th>
				<th>Date</th>
				<th>View Post</th>
				<th>Edit</th>
				<th>Delete</th>
				<th>Views</th>
			</tr>
		</thead>
		<tbody>
			<tr>

			<?php 
				$query = "SELECT * FROM posts ORDER BY post_id DESC ";
				$select_posts = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($select_posts)) {
					$post_id = $row["post_id"];
					$post_author = $row["post_author"];
					$post_title = $row["post_title"];
					$post_category_id = $row["post_category_id"];
					$post_status = $row["post_status"];
					$post_image = $row["post_image"];
					$post_tags = $row["post_tags"];
					$post_comment_count = $row["post_comment_count"];
					$post_date = $row["post_date"];
					$post_views = $row["post_views_count"];

					echo "<tr>";
					?>
					<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
					<?php
					echo "<td>$post_id</td>";
					echo "<td>$post_author</td>";
					echo "<td>$post_title</td>";

					$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";

					$select_categories_id = mysqli_query($connection, $query);
					while($row = mysqli_fetch_assoc($select_categories_id)) {
						$cat_id 		= $row["cat_id"];
						$cat_title 	= $row["cat_title"];

						echo "<td>$cat_title</td>";
					}

					echo "<td>$post_status</td>";
					echo "<td><img class='img-responsive' src='../images/$post_image' alt='post image'></td>";
					echo "<td>$post_tags</td>";

					// updating comment count
					$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
					$send_comment_query = mysqli_query($connection, $query);
					$row = mysqli_fetch_array($send_comment_query);
					$comment_id = $row['comment_id'];
					$count_comments = mysqli_num_rows($send_comment_query); 

					echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
					echo "<td>$post_date</td>";
					echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
					echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
					echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?') \" href='posts.php?delete={$post_id}'>Delete</a></td>";
					echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset the view count?') \" href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
					echo "</tr>";

				}?>
		</tbody>
	</table>
</form>

<?php 
	if(isset($_GET['delete'])) {
		
		$the_post_id = $_GET['delete'];
		
		$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
		$delete_query = mysqli_query($connection, $query);
		
		header("location: posts.php");
	}

	if(isset($_GET['reset'])) {
		
		$the_post_id = $_GET['reset'];
		
		$query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
		$reset_query = mysqli_query($connection, $query);
		
		header("location: posts.php");
	}
?>
