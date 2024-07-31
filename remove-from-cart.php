<?php
session_start();

if (isset($_GET['drama_id'])) {
    $drama_id = $_GET['drama_id'];

    if (isset($_SESSION['cart'][$drama_id])) {
        unset($_SESSION['cart'][$drama_id]);
    }

    header("Location: cart.php");
    exit();
}
?>
