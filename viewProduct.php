<?php
// Start the session
session_start();

include_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart Example</title>
</head>
<body>
    <h1>Product Listing</h1>
	
	<a href="cart.php">View Cart</a>

    <?php

    if (isset($_SESSION['message'])) {
        echo '<p style="color: green;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }

    $result = $conn->query("SELECT * FROM products");

    if ($result->num_rows > 0) {
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
			$product_name = $row['name'];
			$price = $row['price'];
			$id = $row['product_id'];	
echo <<< _END
    <li>
    {$product_name} \t \${$price}
    <form action='add-to-cart.php' method='post'>
        <input type='hidden' name='product_id' value='{$id}'>
        <input type='hidden' name='shoppingcart' value='shoppingcart'>
        <input type='submit' value='Add To Cart'>
    </form>
    </li><br>
_END;			
			
        }
        echo '</ul>';
    } else {
        echo '<p>No products found.</p>';
    }
    ?>

  


</body>
</html>