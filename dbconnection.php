<?php
$hn = 'localhost';
$un = 'root'; 
$pw = ''; 
$db = 'final';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
