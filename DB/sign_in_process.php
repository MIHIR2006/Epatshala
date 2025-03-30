<?php

  session_start();

  require_once("connect.php");

  $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

  $email = $_POST['email'];

  $password = $_POST['password'];

  $query = "SELECT * FROM user WHERE (email = '$email' AND password = '$password')";

  $result = mysqli_query($db,$query) or die("query does not run".mysqli_error($db));

  $rowcount = mysqli_num_rows($result);

  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  

  if ($rowcount == 1){

    $_SESSION['id'] = $row['id'];

    $_SESSION['name'] = $row['name'];

    $_SESSION['email'] = $row['email'];

    header("Location: ../index.php");

  }

  else{

    header("Location: ../others/signin.php");
  }

?>
