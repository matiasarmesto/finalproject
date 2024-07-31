<?php
require_once 'User.php'; 
session_start();

$page_roles = array('user', 'admin'); 

require_once 'dbconnection.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_amount = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

   
        $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, total_amount) VALUES (?, NOW(), ?)");
        $stmt->bind_param('id', $user_id, $total_amount);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();


        $stmt = $conn->prepare("INSERT INTO order_items (order_id, drama_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $id => $item) {
            $stmt->bind_param('iiid', $order_id, $id, $item['quantity'], $item['price']);
            $stmt->execute();
        }
        $stmt->close();


        $stmt = $conn->prepare("INSERT INTO purchases (user_id, drama_id, purchase_date) VALUES (?, ?, NOW())");
        foreach ($_SESSION['cart'] as $id => $item) {
            $stmt->bind_param('ii', $user_id, $id);
            $stmt->execute();
        }
        $stmt->close();

        unset($_SESSION['cart']);

  
        header("Location: thankyou.php?order_id=" . $order_id);
        exit();
    } else {
        echo "Your cart is empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Trebuchet MS, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #9370Db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #805cbf;
        }
    </style>
</head>
<body>
    <?php include('header.html'); ?>
    <div class="container">
        <h1>Checkout</h1>
        <form action="checkout.php" method="post">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="billing_address">Billing Address</label>
            <input type="text" id="billing_address" name="billing_address" required>

            <label for="state">State</label>
            <input type="text" id="state" name="state" required>

            <label for="zipcode">Zipcode</label>
            <input type="text" id="zipcode" name="zipcode" required>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="credit_card_number">Credit Card Number</label>
            <input type="text" id="credit_card_number" name="credit_card_number" required>

            <label for="exp_date">Expiration Date</label>
            <input type="date" id="exp_date" name="exp_date" required>

            <input type="submit" value="Purchase">
        </form>
    </div>
</body>
</html>
