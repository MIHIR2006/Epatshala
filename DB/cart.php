<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body>

  <?php
    require '../others/header.php';
    if(array_key_exists('cart',$_SESSION)){
    $products = $_SESSION['cart'];
    echo "<table border='1' class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th> cname </th>";
    echo "<th> price </th>";
    echo "<th> Remove </th>";
    echo "</tr>";
    echo "</thead>";
    $total = 0;
    foreach ($products as $key => $value) {
      $ptotal = $value['price'] * $value['quantity'];
      $total = $total + $ptotal;
      echo "<tbody>";
      echo "<tr>";
      echo "<td>".$value['cname']."</td>";
      echo "<td>".$value['price']."</td>";
      echo "<td><a href='removecart.php?c_id=$value[c_id]'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
      echo "</tr>";
      echo "</tbody>";
    }
    echo "</table>";

    if ($total > 0){
      echo "<table border='1' class='table table-striped'>";
      echo "<tr>";
      echo "<td>GRAND TOTAL:</td>";
      echo "<td>$total</td>";
      echo "<td>";
      echo "<div class='user_option'>";
      echo "<a href='../payfast/process_payment.php' class='btn btn-primary'>check out</a>";
      echo "</div>";
      echo "</td>";
      echo "</tr>";
      echo "</table>";
    }
    }else{
  echo '<div class="alert alert-secondary" role="alert">
  Cart Is Empty
</div>         <div class = "mb-3">  <a href="../others/courses.php" class="btn btn-outline-secondary btn-lg">Check out our courses</a> </div>';
    }
    require '../others/footer.php';
  ?>

</body>

</html>