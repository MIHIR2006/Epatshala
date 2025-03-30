<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','Jitesh@123');

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);

$query = "CREATE DATABASE patshala";

if (mysqli_query($db,$query)){
	echo "Query run succesfully";
}else{
	echo "query doesn't run".mysql_error($db);
}

?>