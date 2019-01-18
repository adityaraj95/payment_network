<script src="js/slider/js/jquery-v1.8.2.js"></script>
<?PHP

	include_once 'init.php';
   
	
		//filterURL($_SERVER['REQUEST_URI'], 'ADVANCED');
		$btnvalue = "Login";
		$btnname = "btnlogin";
		
		
	
			 
				$db=mysqli_connect("localhost", "root", "", "njitpaytm");
							if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE pEmailID = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $msg = "Your Login Name or Password is invalid";
      }
   }
					
					
	
	ob_end_flush();
//	start header
	//require_once("includes/userHeader.php");

?>

<!DOCTYPE html>

<html lang="en-us" id="extr-page">

<head>

<meta charset="ISO-8859-2">

<title>TJIN PAYMENT</title>

<meta name="description" content="">

<meta name="author" content="">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">

<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">

<link rel="shortcut icon" href="img/favicon.png">

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">



</head>

<body class="animated fadeInDown">

<header id="header">

  <div id="logo-group"> <span id="logo"> <img src="img/logo.png" alt="SmartAdmin"> </span> </div>

  <span id="extr-page-header-space"></span> </header>

<div id="main" role="main">

  <!-- MAIN CONTENT -->

  <div id="content" class="container">

	<?PHP

		if(isset($msg) && $msg != '')

		{

	?>

		<div class="alert alert-danger fade in">

		  <button class="close" data-dismiss="alert">X</button>

		  <i class="fa-fw fa fa-times"></i><strong>Error!</strong> <?PHP echo $msg; ?>

		</div>

	<?PHP

		}

	?>

    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 hidden-xs hidden-sm"> </div>

      <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">

        <div class="well no-padding">

          <form action="" id="btnlogin" class="smart-form client-form" method="post" role="form" enctype="multipart/form-data">

            <header> Sign In </header>

            <fieldset>

              
              <section>

                <label class="label">Email*</label>

                <label class="input"> <i class="icon-append fa fa-envelope"></i>

                  <input type="email" name="email" value="" required>

                  <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Enter your Email</b> </label>

              </section>
			  
			  <section>

                <label class="label">Password *</label>

                <label class="input"> <i class="icon-append fa fa-key"></i>

                  <input type="password" name="password" value="" required>

                  <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> Enter your Password</b> </label>

              </section>
			  
			  
			  
			 
              
            </fieldset>

            <footer>

			  <input type="submit" value="<?php echo $btnvalue; ?>" class="btn btn-success" name="<?php echo $btnname;?>" />
			  <input type="submit" value="Forgot Password" class="btn btn-success" name="btnforgot" />

			

            </footer>

          </form>

        </div>

      </div>	  

      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 hidden-xs hidden-sm"><input type="hidden" value="<?PHP echo $_SERVER['REMOTE_ADDR']; ?>"> </div>

    </div>

  </div>

</div>

<!-- END SHORTCUT AREA -->

<!--================================================== -->

<style>

#retailer {
    display:none;
}
#distributor {
    display:none;
}
</style>
			<script>
	
	$('select[name=occupation]').change(function () {
    if ($(this).val() == 'retailer') {
        $('#retailer').show();
    } else {
        $('#retailer').hide();
    }
	});
	
	$('select[name=occupation]').change(function () {
    if ($(this).val() == 'distributor') {
        $('#distributor').show();
    } else {
        $('#distributor').hide();
    }
	});
	
	
</script>

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->

<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->

<script src="js/jquery.min.js"></script>

<script>

			if (!window.jQuery) {

				document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');

			}

		</script>

<script src="js/jquery-ui.min.js"></script>

<script>

			if (!window.jQuery.ui) {

				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');

			}

		</script>

<!-- IMPORTANT: APP CONFIG -->

<script src="js/app.config.js"></script>

<!-- CUSTOM NOTIFICATION -->

<script src="js/notification/SmartNotification.min.js"></script>

<!-- BOOTSTRAP JS -->

<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY VALIDATE -->

<script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->

<script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->

<script src="js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->

<script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->

<script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices -->

<script src="js/plugin/fastclick/fastclick.min.js"></script>

<!-- MAIN APP JS FILE -->

<script src="js/app.min.js"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->





<!-- PAGE RELATED PLUGIN(S) -->

<script src="js/plugin/jquery-form/jquery-form.min.js"></script>


</body>

</html>