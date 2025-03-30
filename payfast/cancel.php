<?php
session_start();
require_once "config.php";
 
require_once("../DB/connect.php");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
 
$query = "UPDATE `enroll` SET status='canceled' WHERE payment_id=".$_SESSION['payment_id'];
if (mysqli_query($db,$query)) {
    
}
else{
    echo "query does not run".mysqli_error($db);
}
 