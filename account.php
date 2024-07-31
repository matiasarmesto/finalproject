<?php
$page_roles= array('admin','user');

require_once 'checksession.php'; // Ensure this file includes the session check and user retrieval
require_once 'dbconnection.php'; // Ensure this file includes the database connection
require_once 'header.html';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the current user's username
$username = $_SESSION['user']->username;

// Fetch user details from the users table
$query = "SELECT firstname, lastname, email FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare statement failed: " . $conn->error);
}
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure you have a styles.css file for styling -->
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
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
        .btn-red {
            background-color: #ff0000;
        }
        .btn-red:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
 <div class="container">
        <div class="content">
   			 <h1>Account Details</h1>
   			 <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
   			 <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
   			 <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastname); ?></p>
  			 <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
  			<a href="updateaccount.php" class="btn">Update Account</a>
            <a href="deleteaccount.php" class="btn btn-red">DELETE Account</a>
        </div>
    </div>
</body>
</html>
