<?php 

session_start();

require_once("connect.php");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "CREATE TABLE enroll"."(id INT AUTO_INCREMENT,total BIGINT(50),uid INT(50),PRIMARY KEY(id))";

if (mysqli_query($db,$query)){
	echo "Query run successfully";
}
else{
	echo "Query does not run";
}


$query = "CREATE TABLE enroll_details"."(id INT AUTO_INCREMENT,oid INT(50) NOT NULL,c_id INT(50),PRIMARY KEY(id))";

if (mysqli_query($db,$query)){
	echo "Query run successfully";
}
else{
	echo "Query does not run";
}


?>