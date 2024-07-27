
<?php
require_once 'dbconnection.php';
require_once 'header.html';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    }
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $account_type = $_POST['account_type'];

    $sql = "INSERT INTO users (firstname, lastname, username, email, password, account_type) VALUES ('$firstname','$lastname','$username', '$email', '$password', '$account_type')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login.php after successful account creation
        header("Location: login.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit(); // Ensure no further code is executed after the redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body { font-family: 'Arsenal', sans-serif; background-color: #fff; margin: 0; padding: 0; }
        header { background: #9370Db; color: #fff; padding: 15px; text-align: center; }
        nav { margin: 0; padding: 0; list-style: none; text-align: center; }
        nav li { display: inline; margin: 0 10px; }
        nav a { text-decoration: none; color: #fff; cursor: pointer; }
        .container { width: 80%; margin: auto; overflow: hidden; }
        .content { padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .radio-group { display: flex; align-items: center; }
        .radio-group label { margin-right: 10px; }
        .radio-group input { margin-right: 5px; }
    </style>
</head>
<body>
    <header>
        <h1>Create Account</h1>
    </header>
    <div class="container">
        <div class="content">
            <h2>Account Details</h2>
            <form action="createaccount.php" method="post">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Type of Account:</label>
                    <div class="radio-group">
                        <label for="user">User</label>
                        <input type="radio" id="user" name="account_type" value="user" required>
                        <label for="admin">Admin</label>
                        <input type="radio" id="admin" name="account_type" value="admin" required>
                    </div>
                </div>
                <input type="submit" value="Create account">
            </form>
        </div>
    </div>
</body>
</html>
