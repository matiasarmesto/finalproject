<?php
$page_roles=array('admin');
session_start();
require_once 'dbconnection.php';
require_once 'header.html';
//require_once 'checksession.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid actor ID.");
}

$actor_id = (int)$_GET['id'];
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute delete query
$sql = "DELETE FROM actors WHERE actor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $actor_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<p>Actor deleted successfully.</p>";
} else {
    echo "<p>Failed to delete actor or actor not found.</p>";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Actor</title>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Trebutchet MS, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
            padding: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            background-color: #805cbf;
        }
    </style>
</head>
<body>
    <a href="viewdramalist.php" class="btn">Back to Home</a>
</body>
</html>
