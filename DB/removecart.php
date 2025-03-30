<?php

session_start();

$id = $_GET['c_id'];
if(array_key_exists('cart',$_SESSION)){
    foreach($_SESSION['cart'] as $key => $val){
        if($val['c_id'] === $id)
        unset($_SESSION['cart'][$key]);
    }
}

// unset($_SESSION['cart'][$id]);

header("Location:cart.php");