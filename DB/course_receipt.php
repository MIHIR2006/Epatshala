<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
			<?php
                
				require '../others/header.php';

	            require_once('connect.php');

	            $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	            $id = $_GET['o_id'];

	            $query = "SELECT * FROM `enroll` INNER JOIN enroll_details ON enroll.id = enroll_details.oid INNER JOIN courses ON enroll_details.c_id = courses.c_id WHERE oid = $id";

	            $result = mysqli_query($db,$query) or die(header("Location:../index.php"));

	            echo "<table border='0' class='table table-striped'>";
	            echo "<tr>";
	            echo "<th>Product Name</th>";
	            echo "<th>Product Price</th>";
	            echo "<th>Payment</th>";
	            echo "<th>Receipt</th>"; 
	            echo "</tr>";

	            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	            echo "<tr>";
		        echo "<td>$row[c_name]</td>";
		        echo "<td>$row[price]</td>";
		   		echo "<td>Done</td>";
		   		echo "<td>";
	            echo "<div class='user_option'>";
	            echo "<a onclick='window.print()' class='btn btn-primary fw-bold px-4 py-2 mt-2 mb-2'>Receipt</a>";
	            echo "</div>";
	            echo "</td>";
		        echo "</tr>";

	            

	            echo "</table>";

	            require '../others/footer.php';
            ?>

</body>
</html>