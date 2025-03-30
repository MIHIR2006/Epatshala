<?php
session_start();

require_once "config.php";
 
require_once("../DB/connect.php");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$payment_id = $_SESSION['payment_id'];

$query = "SELECT * FROM `enroll` WHERE payment_id='".$payment_id."'";

if (mysqli_query($db,$query)) {
    unset($_SESSION['cart']);
    unset($_SESSION['payment_id']);
    header("Location:../DB/myaccount.php");
}
else{
    echo "query does not run".mysqli_error($db);
}
 
// // check if transaction exists
// $db = new DB;
// $transaction = $db->get_transaction($payment_id);
// // if ('completed' == $transaction['status']) {
// if ('pending' == $transaction['status']) {
//     echo "Payment is successful. Your Payment ID is $payment_id";
// } elseif ('failed' == $transaction['status']) {
//     echo "Payment is failed.";
// }

// echo "<br>";
// echo "<a href='form.php'>Back</a>";