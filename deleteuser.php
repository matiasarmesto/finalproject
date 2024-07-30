<?php
$page_roles=array('admin');

require_once 'login.php';
require_once 'header.html';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) { echo "User deleted successfully"; }
    else { echo "Error: " . $conn->error; }
}
$conn->close();
header('Location: ViewUsers.php');
?>