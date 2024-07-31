<?php
session_start();
include('header.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Order Confirmed</h1>
            <p>Thank you for your purchase!</p>
            <p>Your order has been successfully placed and is being processed.</p>
        </div>
    </div>
</body>
</html>
