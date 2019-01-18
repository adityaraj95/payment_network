<html>
<body>

<?php
session_start();
include_once("prod_config.php");
$email = $_SESSION['email'];

//add product to session or create new one
if(isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_qty"]>0)
{
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product['return_url']); 
	
 	//we need to get product name and price from database.
    $statement = $mysqli->prepare("SELECT product_name, price, retail_price, offer_price FROM pdh_products WHERE product_code=? LIMIT 1");
    $statement->bind_param('s', $new_product['product_code']);
    $statement->execute();
    $statement->bind_result($product_name, $price, $retail_price, $offer_price);
	
	while($statement->fetch()){
		
		//fetch product name, price from db and add to new_product array
        $new_product["product_name"] = $product_name; 
        $new_product["product_price"] = $price;
		$new_product["product_retail"] = $retail_price;
		$new_product["product_offer"] = $offer_price;
	
        
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['product_code']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
            }           
        }
        $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
		$_SESSION['msg'] = 3;
    } 
}


//delete data product

if(isset($_POST["delete"]))
{   
$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");

foreach($_POST["delete"] as $key => $value){
	$selectorderid = "select * from pdh_retailorders where date = '$value' ";	 
	$orderid = mysqli_query($conn, $selectorderid);
	$orderidpro = mysqli_fetch_assoc($orderid);
	$orderid = $orderidpro['orderid'];
	$delprod = "delete from pdh_retailorders where date = '$value'";
	mysqli_query($conn, $delprod);
		
		
	$delprod = "delete from pdh_orderitems where orderid = '$orderid'";
	mysqli_query($conn, $delprod);
}
}

if(isset($_POST["delete_code"]))
{  		
$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");

foreach($_POST["delete_code"] as $key => $value){
			
			$delprod = "delete from pdh_orderitems where orderitemid = '$value'";
				mysqli_query($conn, $delprod);
		}	
}

//update product quantity
if (isset($_POST["orderitemid"]))
{
	$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");
//	$quantity = array();
	//$quantity[] = $_SESSION['quantity'];
	foreach($_POST["orderitemid['.$quantity.']"] as $key => $value){
//	$quantity = $value["quantity"];
	$insert_ord = "UPDATE pdh_orderitems SET quantity = 4 where orderitemid = $value";
		$mysqli -> query ($insert_ord);
	}
	
}



if(isset($_POST['reorder']))
	{

	$orderid = $_SESSION['orderid'];
	
	$conn = mysqli_connect('localhost','pegasusd_shalman','shalman12@','pegasusd_shalman');
	$que = "SELECT * from pdh_retailorders where orderid='$orderid'";
	$no = mysqli_query($conn,$que);

	foreach($no as $rows)
	{
		$total = $rows['total'];
		$saved_am = $rows['saved_amount'];
		$tax = $rows['tax'];
	}
	
	$timestamp = date("Y-m-d H:i:s");
	$ordercompleted = 0;
	
	$insert_ord = "INSERT INTO pdh_retailorders (email, ordercompleted, total, saved_amount, tax, shipping_cost, date) VALUES ('$email', '$ordercompleted', '$total', '$saved_am', '$tax', '$shipping_cost', '$timestamp')";
	$mysqli -> query ($insert_ord);
	$fetch_ord = "SELECT * FROM pdh_retailorders WHERE email = '$email' AND ordercompleted = '$ordercompleted'";
		$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");
		$result = mysqli_query($conn, $fetch_ord);
		$result = mysqli_fetch_assoc($result);
		
		
		$id = $result['orderid'];
		
		$fetch_ord = "SELECT * FROM pdh_orderitems WHERE orderid = '$orderid'";
		$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");
		$res = mysqli_query($conn, $fetch_ord);
		foreach($res as $result)
		{
			$code = $result['product_code'];
			$name = $result['product_name'];
			$quantity = $result['quantity'];
			$price = $result['price'];
					$sql_code="INSERT INTO pdh_orderitems (orderid, product_code, product_name, quantity, price) VALUES ('$id', '$code', '$name', '$quantity', '$price')";
					$mysqli -> query($sql_code);
		}
			$ordercompleted = 1;
			$insert_ord = "UPDATE pdh_retailorders SET ordercompleted = '$ordercompleted'";
			$mysqli -> query ($insert_ord);
			
			$_SESSION['msg'] = 1;

			
		}




//checkout product
if(isset($_POST["check"]))
{
	        $product_name   = array();
			$product_qty    = array();
			$product_offer  = array();
			$product_retail = array();
			$product_code = array();
			$count = 0;
			
	foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$product_name[] = $cart_itm["product_name"];
			$product_qty[] = $cart_itm["product_qty"];
			$product_offer[] = $cart_itm["product_offer"];
			$product_retail[] = $cart_itm["product_retail"];
			$product_code[] = $cart_itm["product_code"];
			
			$count = $count + 1;
		}
	//	$insert_ord = "INSERT INTO pdh_retailorders (email) VALUES ('$email')";
	//	$mysqli -> query ($insert_ord);
		$fetch_ord = "SELECT * FROM pdh_retailorders WHERE email = '$email'";
		$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");
		$result = mysqli_query($conn, $fetch_ord);
		$result = mysqli_fetch_assoc($result);
		$ordercompleted = $result['ordercompleted'];
		$orderid = $result['orderid'];
		//$count = $count-1;
		if ($ordercompleted = 1 or $ordercompleted == "")
		{
			$ordercompleted = 0;
			$timestamp = date("Y-m-d H:i:s");
			$total = $_SESSION['total'];
			$totalsave = $_SESSION['totalsave'];
			$shipping_cost = $_SESSION['shipping'];
		$list_tax = $_SESSION['tax'];
			$insert_ord = "INSERT INTO pdh_retailorders (email, ordercompleted, total, saved_amount, tax, shipping_cost, date) VALUES ('$email', $ordercompleted, $total, $totalsave, $list_tax, $shipping_cost, '$timestamp')";
		$mysqli -> query ($insert_ord);

		$fetch_ord = "SELECT * FROM pdh_retailorders WHERE email = '$email' AND ordercompleted = '$ordercompleted'";
		$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");
		$result = mysqli_query($conn, $fetch_ord);
		$result = mysqli_fetch_assoc($result);
		
		
		$orderid = $result['orderid'];
		
for ($i = 0; $i <= $count; $i++){ 
$sql_code="INSERT INTO pdh_orderitems (orderid, product_code, product_name, quantity, price) VALUES ($orderid, '$product_code[$i]', '$product_name[$i]', $product_qty[$i], $product_offer[$i])";
			mysqli_query($conn, $sql_code);
			}
			$ordercompleted = 1;
			$insert_ord = "UPDATE pdh_retailorders SET ordercompleted = $ordercompleted";
		$st = $mysqli -> query ($insert_ord);
		}
		
			$_SESSION['msg'] = 1;
			

			foreach($_SESSION["cart_products"] as $cart_itm){
			
			unset($_SESSION["cart_products"]);
		}	
			
		unset ($_SESSION["cart_products"]);		
		

		$q = "select email from pdh_admin";
		$adm = mysqli_query($conn, $q);
		$fetch = mysqli_fetch_assoc($adm);
		
		$from		= 'hemraj99@gmail.com';
		$to 		= $_SESSION['email'];
		$to_ad 		= $fetch;
		$admin = 'Order under orderid: '.$id.' has been placed';
		$user = 'Your order has been placed. Saved amount: Rs. '.$result['saved_amount'].' Tax: Rs. '.$result['tax'].' Shipping cost: Rs. '.$result['shipping_cost'].' Total: Rs. '.$result['total'];
		$ok = mail($to, $from, $user);
		$ok1 = mail($to_ad, $from, $admin);
		
}


//update or remove items 
if(isset($_POST["product_qty"]) || isset($_POST["remove_code"]))
{
	//update item quantity in product session
	if(isset($_POST["product_qty"]) && is_array($_POST["product_qty"])){
		foreach($_POST["product_qty"] as $key => $value){
			if(is_numeric($value)){
				$_SESSION["cart_products"][$key]["product_qty"] = $value;
			}
		}
	}
	//remove an item from product session
	if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
		foreach($_POST["remove_code"] as $key){
			
			unset($_SESSION["cart_products"][$key]);
		}	
	}
}

//back to return url
$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);

?>


</body>
</html>