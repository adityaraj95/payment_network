<?PHP 
$orderid =  array();
$orderid[0] = "1";
$orderid[1] = "2";
$product_code = array();
$product_code[0] = "1";
$product_code[1] = "2";
$count = 1;
$i=0;
for ($i = 0; $i <= $count; $i++){ 
$sql_code="INSERT INTO pdh_orderitems (orderid, product_name) VALUES ($orderid[$i], $product_code[$i])";
$conn = mysqli_connect("localhost", "pegasusd_shalman", "shalman12@", "pegasusd_shalman");
			mysqli_query($conn, $sql_code);
			echo $orderid[$i];
			echo $sql_code;
			}
			?>