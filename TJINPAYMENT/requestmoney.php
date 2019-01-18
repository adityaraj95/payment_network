
<?PHP
date_default_timezone_set('America/New_York');
	
	session_start();
include_once("prod_config.php");
if (!isset($_SERVER['HTTP_REFERER'])){

   header("Location: index.php"); }

else {
	$payeeemail = $_SESSION['login_user'];
	$db=mysqli_connect("localhost", "root", "", "njitpaytm");
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $payeremail = mysqli_real_escape_string($db,$_POST['email']);
      $reqamount = mysqli_real_escape_string($db,$_POST['amount']);
	  $reqmemo = mysqli_real_escape_string($db,$_POST['momo']);
      $date = date('Y-m-d H:i:s');
	  
      $payeesql = "SELECT * FROM user WHERE pEmailID = '$payeeemail'";
      $result = mysqli_query($db,$payeesql) or die('error getting data from database');
	  
	  $sql2="SELECT * FROM user WHERE pEmailID='$payeremail'";
	  $result2=mysqli_query($db,$sql2) or die('error getting data from database');

      $row = mysqli_fetch_array($result);
	  $payeeuserId = $row['userID'];
	  $row2 = mysqli_fetch_array($result2);
	  $payoruserid=$row2['userID'];
	  
	  $sqlgettokenID="SELECT * FROM token WHERE userID='$payoruserid'";
	  $resulttoken=mysqli_query($db,$sqlgettokenID) or die('error db');
	  $rowtoken=mysqli_fetch_array($resulttoken);
	  $payortokenid=$rowtoken['tokenID'];	

	  $sqlrequestpayment="INSERT INTO requestpayment (RequestID, payeeUserID, requestDateTime, amount, memo) VALUES (NULL, '$payeeuserId', '$date', '$reqamount', '$reqmemo');";
	  $result5=mysqli_query($db,$sqlrequestpayment);
	  $requestid = mysqli_insert_id($db);
	  $sqlrequestpaymenttoken = "INSERT INTO requestpaymenttoken (RequestID, payorTokenId) VALUES ('$requestid', '$payortokenid')";
	  $result6=mysqli_query($db,$sqlrequestpaymenttoken);
	  $error = mysqli_error($db);
	  echo "<script>console.log($error)</script>";

echo "Transfer Completed";

   }
					
					
	
	ob_end_flush();
//	start header
	//require_once("includes/userHeader.php");

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

<div class="cart-view-table-back">
 <form action="" id="btnlogin" class="smart-form client-form" method="post" role="form" enctype="multipart/form-data">

            <header> Send Money </header>

            <fieldset>

              
              <section>

                <label class="label">Request Email</label>

                <label class="input"> <i class="icon-append fa fa-envelope"></i>

                  <input type="email" name="email" value="" required>

                 

              </section>
			  
			  <section>

                <label class="label">Amount</label>

                <label class="input"> <i class="icon-append fa fa-money"></i>

                  <input type="text" name="amount" value="" required>

                  <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> </b> </label>

              </section>
			   <section>

                <label class="label">Memo</label>

                <label class="input"> <i class="icon-append fa fa-list"></i>

                  <input type="text" name="momo" value="" required>

                  <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> </b> </label>

              </section>
			  
			  
			  
			 
              
            </fieldset>

            <footer>

			  <input type="submit" value="Request" class="btn btn-success" name="SEND" />
			  

			

            </footer>

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
<?php }?>