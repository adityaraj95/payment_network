<?PHP



include_once("prod_config.php");
session_start();
$myusername = $_SESSION['login_user'];
//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
if (!isset($_SERVER['HTTP_REFERER'])){

   header("Location: index.php"); }

else {

   
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

<div style="color:Green;  font-weight:bold; font-size:15px;">
<?php 
if($_SESSION['msg'] == 5)
{
	if($_SESSION['no'] == 1)
	{
?>

<?php
	}
	else{
?>

<?php
} unset($_SESSION['no']);
} 
if ($_SESSION['msg'] == 3)
	{
?>

<?php	

}
if ($_SESSION['msg'] == 2)
	{
?>
<div class="alert alert-success text-center" align="center">Welcome to TJIN Payment Network</div>
<?php	

}

if ($_SESSION['msg'] == 1)
{
?>

<?php	
unset($_SESSION['msg']);
}
if ($_SESSION['msg'] == 0 ){?>

<?php	
}

unset ($_SESSION['msg']);
//unset ($_SESSION['noproducts']);

 ?>



<!--================================================== -->


</body>

</html>
<?php }?>