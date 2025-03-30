<?php

require_once('connect.php');

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "CREATE TABLE courses"."(c_id INT AUTO_INCREMENT,c_name CHAR(30) NOT NULL,c_image VARCHAR(50)NOT NULL,price BIGINT(10) NOT NULL,description TEXT NOT NULL,PRIMARY KEY(c_id))";

if(mysqli_query($db,$query)){
	echo "query run successfully";
}else{
	echo "query unsuccessfull".mysqli_error($db);
}

?>
