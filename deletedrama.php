<?php
$page_roles=array('admin');
session_start();
require_once 'dbconnection.php'; 
require_once 'header.html';
//require_once 'checksession.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drama_id'])) {
    $drama_id = intval($_POST['drama_id']); // Sanitize the input

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "DELETE FROM dramas WHERE drama_id = $drama_id";
    if ($conn->query($query) === TRUE) {
        header("Location: viewdramalist.php?message=Drama deleted successfully");
        exit();
    } else {
        die("Error deleting record: " . $conn->error);
    }

    $conn->close();
} else {
    die("Invalid request");
}
?>
