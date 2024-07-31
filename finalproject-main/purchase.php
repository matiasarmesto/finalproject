<?php
$page_roles = array('user', 'admin');

require_once 'dbconnection.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['drama_id'])) {
    $drama_id = $_GET['drama_id'];
} else {
    die("No drama ID provided.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $first_name = sanitize($conn, $_POST['first_name']);
    $last_name = sanitize($conn, $_POST['last_name']);
    $billing_address = sanitize($conn, $_POST['billing_address']);
    $state = sanitize($conn, $_POST['state']);
    $zipcode = sanitize($conn, $_POST['zipcode']);
    $phone_number = sanitize($conn, $_POST['phone_number']);
    $credit_card_number = sanitize($conn, $_POST['credit_card_number']);
    $exp_date = sanitize($conn, $_POST['exp_date']);
    $cvv = sanitize($conn, $_POST['cvv']);

 
    echo "Purchase successful!";

    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>
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
        .content {
            padding: 20px;
        }
        .form-box {
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
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #805cbf;
        }
    </style>
</head>
<body>

    <?php include 'header.html'; ?>

    <div class="container">
        <div class="content">
            <div class="form-box">
                <h2>Purchase</h2>
                <form action="purchase.php?drama_id=<?php echo htmlspecialchars($drama_id); ?>" method="post">
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

                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" required>
                    
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" required>
                    
                    <input type="submit" value="Purchase">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
