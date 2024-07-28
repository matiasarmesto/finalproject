<?php
require_once 'header.html';
require_once 'dbconnection.php';
require_once 'sanitize.php';
require_once 'user.php'; // Include the user class

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $tmp_username = sanitize($conn, $_POST['username']);
    $tmp_password = sanitize($conn, $_POST['password']);
    
    $query = "SELECT password FROM users WHERE username = '$tmp_username'";
    $result = $conn->query($query); 
    if (!$result) {
        die($conn->error);
    }
    
    $passwordFromDB = ''; // Initialize the variable
    if ($result->num_rows > 0) {  // there is more than 0 row
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {    
            $passwordFromDB = $row['password'];
        }
        
        // Compare passwords
        if (password_verify($tmp_password, $passwordFromDB)) {
            echo "successful login<br>";
            session_start();
            
            $user = new User($tmp_username);            
            $_SESSION['user'] = $user;
            
            header("Location: viewdramalist.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
    
    $conn->close();
} else {
    // Only output HTML if the form hasn't been submitted
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KDrama Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .login-box {
            background: #fff;
            padding: 20px;
            margin: 50px auto;
            box-shadow: 0px 0px 10px 0px #000;
            max-width: 300px;
            width: 100%; 
        }
        .login-box label {
            display: block;
            margin-bottom: 8px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"],
        .login-box input[type="submit"] {
            width: 100%;
            padding: 8px; 
            margin-bottom: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box; 
        }
        .login-box input[type="submit"] {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .link {
            display: block;
            margin-top: 10px;
            text-align: center;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="login-box">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
    <a href="createaccount.php" class="link">Create new account</a>
</body>
</html>
<?php
}
?>

