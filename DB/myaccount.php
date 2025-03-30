<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

  <?php

    require '../others/header.php';

    require_once('connect.php');

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    $id = $_SESSION['id'];

    $query = "SELECT * FROM user WHERE id = $id";

    $result = mysqli_query($db,$query) or die(header("Location: ../index.php"));

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $user_id = $row['id'];
              
    echo "<table border='0' class='table table-striped'>";
    echo "<tr>";
    echo "<td> Name </td>";
    echo "<td> $row[name] </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> Register E-mail </td>";
    echo "<td> $row[email] </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> Phone Number </td>";
    echo "<td> $row[phone_number]</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Course Enrolled ?? ??</td>";

    $query = "SELECT * FROM enroll WHERE uid = $id";

    $result = mysqli_query($db,$query) or die(header("Location: ../index.php"));

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $user_id = $row['uid'];

    $price = $row['total'];

    if ($user_id > 0){
      echo "<td>yes,Your Course Has Been placed Successfully Enrolled</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td colspan='2'>";
      echo "<div class='user_option'>";
      echo "<a href='course_list.php' class='btn btn-primary fw-bold px-4 py-2 mt-2 mb-2'>Click ! here to download your receipts</a>";
      echo "</div>";
      echo "</td>";
      echo "</tr>";
    }else{
      echo "<td>Not Yet...</td>";
      echo "</tr>";
    }

    echo "</table>";

    require '../others/footer.php';
?>