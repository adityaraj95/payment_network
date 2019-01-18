<?php
session_start();
include_once("prod_config.php");
if (!isset($_SERVER['HTTP_REFERER'])){

   header("Location: index.php"); }

else {
$email = $_SESSION['login_user'];}


    
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


<!-- ######### BODY START ############### -->
<body>
<div class="cart-view-table-back">
<h4>Search transactions</h4>
<br>
<form action="" method="POST" >
<b>Start Date : </b> <input type='date' name='start_date' value=''> 
<br>
<br>
<b>End Date : &nbsp;</b> <input type='date' name='end_date' value=''> 

<br>
<input type="submit" name="search" class="btn btn-success"value="Search">
</form>
<br>
<br>
<h4> Outgoing Transaction</h4>

<table width="100%"  cellpadding="6" cellspacing="10" ><thead><tr><th>PaymentID</th><th>Reciever ID</th><th>Amount</th><th>Date/Time</th><th>Memo</th></tr>
  <tbody>
 	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$date1=date_create($_POST['start_date']);
	$startdate = date_format($date1,"Y-m-d H:i:s");
	$date2=date_create($_POST['end_date']);
	$enddate = date_format($date2,"Y-m-d H:i:s");
	
	$profile = "select * from user where pEmailID = '$email'";
	$conn = mysqli_connect('localhost','root','','njitpaytm');
		$result = mysqli_query($conn, $profile);
	$profile = mysqli_fetch_assoc($result);
	
	$userid = $profile["userID"];
	
	$sqlsendpayment = "select *from sendpayment where payorUserID='$userid' and paymentDateTime between \"$startdate\" and \"$enddate\"";
	
	$resultnew= mysqli_query($conn,$sqlsendpayment);
    while($row = mysqli_fetch_assoc($resultnew))
    {
		$paymentId = $row['paymentID'];
		$recieverId = $row['payeeTokenID'];
		$amount = $row['amount'];
		$date = $row['paymentDateTime'];
		$memo = $row['memo'];
		$b=0;
			
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
			
		echo '<tr class="'.$bg_color.'">';
		echo '<td>'.$paymentId.'</td>';
		//echo '<td><input type="number" size="7" maxlength="7" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$recieverId.'</td>';
		echo '<td>'.$amount.'</td>';
		echo '<td>'.$date.'</td>';
		echo '<td>'.$memo.'</td>';
		echo '</tr>';
    }
	}
	?>
	
  </tbody>
</table>
<br>
<br>

<h4>Incoming transactions</h4>

<table width="100%"  cellpadding="6" cellspacing="10" ><thead><tr><th>PaymentID</th><th>Sender ID</th><th>Amount</th><th>Date/Time</th><th>Memo</th></tr>
  <tbody>
 	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$date1=date_create($_POST['start_date']);
	$startdate = date_format($date1,"Y-m-d H:i:s");
	$date2=date_create($_POST['end_date']);
	$enddate = date_format($date2,"Y-m-d H:i:s");
	
	$profile = "select * from user where pEmailID = '$email'";
	$conn = mysqli_connect('localhost','root','','njitpaytm');
		$result = mysqli_query($conn, $profile);
	$profile = mysqli_fetch_assoc($result);
	
	$userid = $profile["userID"];

	$sqlsendpayment = "select *from sendpayment where payeeTokenID='$userid' and paymentDateTime between \"$startdate\" and \"$enddate\"";
	
	$resultnew= mysqli_query($conn,$sqlsendpayment);
    while($row = mysqli_fetch_assoc($resultnew))
    {
		$paymentId = $row['paymentID'];
		$recieverId = $row['payorUserID'];
		$amount = $row['amount'];
		$date = $row['paymentDateTime'];
		$memo = $row['memo'];
		$b=0;
			
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
			
		echo '<tr class="'.$bg_color.'">';
		echo '<td>'.$paymentId.'</td>';
		//echo '<td><input type="number" size="7" maxlength="7" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$recieverId.'</td>';
		echo '<td>'.$amount.'</td>';
		echo '<td>'.$date.'</td>';
		echo '<td>'.$memo.'</td>';
		echo '</tr>';
    }
	
	
	
	}
	
	?>
	
  </tbody>
</table>



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