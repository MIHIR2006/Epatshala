<?php

require_once('connect.php');

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$name = $_POST['name'];

$email = $_POST['email'];

$password = $_POST['password'];

$phone = $_POST['phone'];

$query = "INSERT INTO user(name,email,password,phone_number) VALUES('$name','$email','$password',$phone)";


if (mysqli_query($db,$query)){

    header("Location: ../others/signin.php");

}else{

	 header("Location: ../others/signup.php");
	 
}

?>