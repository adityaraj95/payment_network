<?php
session_start();
include_once("prod_config.php");
if (!isset($_SERVER['HTTP_REFERER'])){

   header("Location: index.php"); }

else {
$email = $_SESSION['login_user'];}
    
	
	$email = $_SESSION['login_user'];
   
	
		//filterURL($_SERVER['REQUEST_URI'], 'ADVANCED');
	
		
	
			 
				$db=mysqli_connect("localhost", "root", "", "njitpaytm");
							if($_SERVER["REQUEST_METHOD"] == "POST") {
								
								
								$nemail = mysqli_real_escape_string($db,$_POST['nemail']);
								
								
								$sqlUSER="UPDATE user set pEmailID='$nemail' where pEmailID='$email'";
								$resultrun=mysqli_query($db,$sqlUSER);
								
								$sqltoken="UPDATE token set pEmailID='$nemail' where pEmailID='$email'";
								$resultrun=mysqli_query($db,$sqltoken);
								
								$_SESSION['login_user'] = $nemail;

							}
	
	
	
	
	
	
	
	
	
	
?>

<!DOCTYPE html>

<html lang="en-us">

<head>

<meta charset="utf-8">

<title><?PHP //echo ADMIN_TITLE; ?></title>

<meta name="description" content="">

<meta name="author" content="">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/prod_style.css" >

<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">

<link rel="shortcut icon" href="img/favicon.png">

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">





</head>

<body>



<!-- ######### HEADER START ############### -->

	<?PHP include_once("includes/userHeader.php"); ?>

<!-- ######### HEADER END ############### -->



<!-- ######### HEADER START ############### -->

	<?PHP include_once("includes/userMenu.php"); ?>

<!-- ######### HEADER END ############### -->
<?php



?>


<!-- ######### BODY START ############### -->
<body>
<div class="cart-view-table-back">
<form method="post" action="updateprofile.php">


<form action="" id="btnlogin" class="smart-form client-form" method="post" role="form" enctype="multipart/form-data">

         
            <fieldset>

              
              <section>


                <label class="input">

                  <input type="email" name="nemail" value="" required>
				  


              </section>
			  
			 
			  
			  
			  
			 
              
            </fieldset>

            <footer>

			  <input type="submit" value="Enter New Email" class="btn btn-success" name="newemail" />
			

			

            </footer>

          </form>
</form>

</div>
<div id="addEmailForm" style="display: none">
	<form action="" method="post">
		<input type="text" name="email" value=""/>
		<input type="submit" name="addemail" ="Submit" />
	</form>
</div>
<!-- Products List End -->

<!-- ######### BODY END ############### -->



<!-- ######### FOOTER START ############### -->

<!-- ######### FOOTER END ############### -->



<!-- END PAGE FOOTER -->

<!-- END SHORTCUT AREA -->

<!--================================================== -->

</body>

</html>