<?php
require_once 'header.html';
require_once 'dbconnection.php';
require_once 'sanitize.php';
require_once 'user.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $tmp_username = sanitize($conn, $_POST['username']);
    $tmp_password = sanitize($conn, $_POST['password']);
    
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $tmp_username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($passwordFromDB);
        $stmt->fetch();
        
        if (password_verify($tmp_password, $passwordFromDB)) {
            $_SESSION['user'] = new User($tmp_username); // Store username in session
            error_log("Login successful for user: $tmp_username");
            header("Location: viewdramalist.php");
            exit();
        } else {
            $error = "Invalid username or password";
            error_log("Invalid password for user: $tmp_username");
        }
    } else {
        $error = "Invalid username or password";
        error_log("Invalid username: $tmp_username");
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KDrama Project</title>
    <style>
      body {
            font-family: Trebuchet MS, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            font-weight:regular;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .content {
            padding: 20px;
        }
        .login-box{
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc
            border-radius:5px;
            background-color:#f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    <div class="container">
        <div class="content">
            <?php if (!isset($_SESSION['user'])): ?>
            <div class="login-box">
                <h2>Login</h2>
                <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
                <form action="login.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <input type="submit" value="Login">
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <a href="createaccount.php" class="link">Create new account</a>
</body>
</html>
