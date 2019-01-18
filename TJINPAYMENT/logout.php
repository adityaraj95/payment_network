<?PHP
	include_once 'init.php';
$email = $_SESSION['login_user'];			$link = mysqli_connect("localhost", "root", "", "njitpaytm");						mysqli_query($link, $updatelogin);unset($_SESSION['login_user']);
    session_destroy();
    header("location: index.php");
exit;
?>