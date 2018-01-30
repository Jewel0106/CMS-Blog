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
                            Welcome to the Admin Page
                            
                            
                            <small><?php echo $_SESSION['firstname'] ?></small>
                        </h1>
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
