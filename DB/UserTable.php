<?php

require_once('connect.php');

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "CREATE TABLE user"."(id INT AUTO_INCREMENT,name CHAR(30),email VARCHAR(40) NOT NULL UNIQUE,password VARCHAR(15),phone_number BIGINT(15),time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,PRIMARY KEY(id))";


if (mysqli_query($db,$query)){
	echo "Query run succesfully";
}else{
	echo "Query does not run".mysqli_error($db);
}

?>