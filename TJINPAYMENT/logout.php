<?PHP
	include_once 'init.php';
$email = $_SESSION['login_user'];
    session_destroy();
    header("location: index.php");
exit;
?>