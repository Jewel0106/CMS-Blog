<?php include "components/db.php"; ?>
<?php include "components/header.php"; ?>

<?php

$msg = "It worked!";




if(isset($_POST['submit'])) {

    $to       = "kaitlynmfolsom@gmail.com";
    $subject  = wordwrap($_POST['subject'], 70);
    $body     = $_POST['body'];
    $header   = "From: " . $_POST['email'];

  // Send mail
  mail($to, $subject, $body, $header);
}

?>

<!-- Navigation --> 
<?php  include "components/nav.php"; ?>
    
<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="contact-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <textarea name="body" class="form-control" id="body" col="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "components/footer.php";?>
