<?php 

session_start();

$cart = [];

if(array_key_exists('cart',$_SESSION)){
    $cart = $_SESSION['cart'];
}


$courses['cname'] = $_POST['cname'];
$courses['c_id'] = $_POST['id'];
$courses['price'] = $_POST['price'];
$courses['quantity'] = 1;

//$cartarr[$_POST['id']] = $courses;

array_push($cart,$courses);

$_SESSION['cart'] = $cart;

header("Location: cart.php");

?>