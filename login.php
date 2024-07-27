<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KDrama Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        header {
            background: #9370Db;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        nav {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: center;
        }
        nav li {
            display: inline;
            margin: 0 10px;
        }
        nav a {
            text-decoration: none;
            color: #fff;
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
    </style>
</head>
<body>
    <header>
        <h1>Login to KDrama Website</h1>
        <nav>
            <ul>
                <li><a href="viewdramalist.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="dramas.php">Dramas</a></li>
                <li><a href="actors.php">Actors</a></li>
            </ul>
        </nav>
    </header>
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
                
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    // Database connection
                    $conn = new mysqli('localhost', 'root', '', 'final');
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        echo "Login successful";
                        // Redirect to home page or user dashboard
                        header("Location: viewdramalist.php");
                        exit();
                    } else {
                        echo "Invalid username or password";
                    }
                    
                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>