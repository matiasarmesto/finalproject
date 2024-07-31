<?php
$page_roles = array('user', 'admin'); // Define the $page_roles variable

require_once 'dbconnection.php';
require_once 'checksession.php';
include('header.html'); // Include the header at the top

$conn = new mysqli($hn, $un, $pw, $db); // Ensure the connection is established

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $first_name = sanitize($conn, $_POST['first_name']);
    $last_name = sanitize($conn, $_POST['last_name']);
    $email = sanitize($conn, $_POST['email']);
    $password = password_hash(sanitize($conn, $_POST['password']), PASSWORD_DEFAULT); // Hash the password

    $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    // Check if the prepare statement was successful
    if ($stmt === false) {
        die("Failed to prepare the statement: " . $conn->error);
    }

    $stmt->bind_param('ssssi', $first_name, $last_name, $email, $password, $user_id);

    if ($stmt->execute()) {
        echo "Account updated successfully!";
        // Redirect to a confirmation page or show a success message
    } else {
        echo "Error updating account: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
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
        input[type="text"], input[type="email"], input[type="password"] {
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
    <div class="container">
        <div class="content">
            <div class="form-box">
                <h2>Update Account</h2>
                <form action="updateaccount.php" method="post">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                    
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    
                    <input type="submit" value="Update">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
