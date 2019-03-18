<?php	/* This is for Pre defineing database name,server name ,tables,user name, password so that change in one place can change all the location where using those */

	/* database configuration "" */
	if(isset($_SERVER['HTTP_HOST'])=='localhost')
	{
		define("SERVER_NAME","localhost");
		define("USER_NAME","root");
		define("PASSWORD","");
		define("DATABASE_NAME","njitpaytm");
	}
	else
	{
		define("SERVER_NAME","localhost");
		define("USER_NAME","root");
		define("PASSWORD","");
		define("DATABASE_NAME","njitpaytm");
	}

	date_default_timezone_set('Asia/calcutta');
	
	$database_connection="mysql:host=".SERVER_NAME.";dbname=".DATABASE_NAME;	/* This is the first parameter for establishing a database connection */
	try 
	{
		$db = new PDO($database_connection, USER_NAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="NO_ENGINE_SUBSTITUTION"'));
   		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) 
	{
    	die($e->getMessage());													/* This will make a database connection and if not connected it will give error */
	}

			
	//Domain URL
	define("FOLDER_PATH", "shalman-ready/");
	define("DOMAIN_NAME", "http://".$_SERVER['HTTP_HOST']."/".FOLDER_PATH);
	define("ADMIN_SITE_URL", DOMAIN_NAME."admin/");

	define("IMAGE_FOLDER", "images/");
	define("IMAGE_PATH", DOMAIN_NAME."images/");
	define("QUESTION_IMAGE", "images/");
	define("ADMIN_QUESTION_IMAGE", '../images/');

	define("JS_PATH", DOMAIN_NAME."js/");
	define("CSS_PATH", DOMAIN_NAME."css/");

	define("ADMIN_TITLE", ".::. Adityaraj .::.");
	define("SITE_TITLE", "Adi ");
	
?>
