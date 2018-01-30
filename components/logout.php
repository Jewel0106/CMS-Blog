
<?php session_start(); ?>

<?php
		// Cancelling the user's session
		$_SESSION['username'] = null;
		$_SESSION['firstname'] = null;
		$_SESSION['lastname'] = null;
		$_SESSION['user_role'] = null;

	// Redirect to home page
	header("Location: ../index.php");

?>