<?php
session_start();
require_once 'dbconnection.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['drama_id'])) {
    $drama_id = $_GET['drama_id'];
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;


    $stmt = $conn->prepare("SELECT * FROM dramas WHERE drama_id = ?");
    $stmt->bind_param('i', $drama_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $drama = $result->fetch_assoc();

    if (!$drama) {
        die("Drama not found!");
    }


    if (isset($_SESSION['cart'][$drama_id])) {
        $_SESSION['cart'][$drama_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$drama_id] = array(
            'title' => $drama['title'],
            'price' => $drama['price'],
            'quantity' => $quantity
        );
    }


    header("Location: cart.php");
    exit();
}
?>
