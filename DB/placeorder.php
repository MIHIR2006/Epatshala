<?php 

session_start();

require_once("connect.php");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$cart = $_SESSION['cart'];

$uid = $_SESSION['id'];

$total = 0;

$courses_arr = array();

foreach ($cart as $key => $value) {
	$ptotal = $value['price'] * $value['quantity'];
	$total = $total + $ptotal;
	$courses_arr[$value[c_id]] = $value[quantity];

}

$query = "INSERT INTO enroll(total,uid) VALUES($total,$uid)";

if (mysqli_query($db,$query)){
	echo "query run succesfully";	
}
else{
	echo "Query doesnt run".mysqli_error($db);
}
$last_id = $db->insert_id;

foreach($courses_arr as $key =>$value){

	$query = "INSERT INTO enroll_details(oid,c_id) VALUES($last_id,$key)";

	if (mysqli_query($db,$query)){
		header("Location:myaccount.php");
	}
	else{
		header("Location:cart.php");
	}
}

unset($_SESSION['cart']);

?>