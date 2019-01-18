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

<!-- ######### HEADER END ############### -->
<?php



?>


<!-- ######### BODY START ############### -->
<body>
<div class="cart-view-table-back">
<h4>Outgoing transactions</h4>
<form method="post" action="cart_update.php">

<table width="100%"  cellpadding="6" cellspacing="10" ><thead><tr><th>PaymentID</th><th>Reciever ID</th><th>Amount</th><th>Date/Time</th><th>Memo</th></tr>
  <tbody>
 	<?php
	$profile = "select * from user where pEmailID = '$email'";
	$conn = mysqli_connect('localhost','root','','njitpaytm');
		$result = mysqli_query($conn, $profile);
	$profile = mysqli_fetch_assoc($result);
	
	$userid = $profile["userID"];
	
	$sqlsendpayment = "select *from sendpayment where payorUserID='$userid'";
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
	?>
	
  </tbody>
</table>
</form>
<br>
<br>
<h4>Incoming transactions</h4>
<form method="post" action="cart_update.php">

<table width="100%"  cellpadding="6" cellspacing="10" ><thead><tr><th>PaymentID</th><th>Sender ID</th><th>Amount</th><th>Date/Time</th><th>Memo</th></tr>
  <tbody>
 	<?php
	$profile = "select * from user where pEmailID = '$email'";
	$conn = mysqli_connect('localhost','root','','njitpaytm');
		$result = mysqli_query($conn, $profile);
	$profile = mysqli_fetch_assoc($result);
	
	$userid = $profile["userID"];

	$sqlsendpayment = "select *from sendpayment where payeeTokenID='$userid'";
	
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
	?>
	
  </tbody>
</table>
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