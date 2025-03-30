<?php

session_start();

require_once("connect.php");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$cname = $_POST['cname'];

$cimage = $_POST['cimage'];

$description = $_POST['desc'];

$price = $_POST['price'];

$file_name_pic = $_FILES['cimage']['name'];

$file_tmp_pic =$_FILES['cimage']['tmp_name'];

move_uploaded_file($file_tmp_pic,"upload/".$file_name_pic);

$path = "upload/".$file_name_pic;

$query = "INSERT INTO courses(c_name,c_image,price,description) VALUES('$cname','$path',$price,'$description')";

if (mysqli_query($db,$query)){
	header("Location: ../index.php");
}
else{
	echo mysqli_error($db);
}

?>