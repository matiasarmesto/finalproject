<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fff; margin: 0; padding: 0; }
        header { background: #9370Db; color: #fff; padding: 15px; text-align: center; }
        nav { margin: 0; padding: 0; list-style: none; text-align: center; }
        nav li { display: inline; margin: 0 10px; }
        nav a { text-decoration: none; color: #fff; cursor: pointer; }
        .container { width: 80%; margin: auto; overflow: hidden; }
        .content { padding: 20px; }
    </style>
</head>
<body>
    <header>
        <h1>Add User</h1>
        <nav>
            <ul>
                <li><a href="viewdramalist.php">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="actors.php">Actors</a></li>
                <li><a href="ViewUsers.php">View Users</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <h2>Add New User</h2>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $conn = new mysqli('localhost', 'root', '', 'final');
                if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

                if ($conn->query($sql) === TRUE) { echo "New user created successfully"; }
                else { echo "Error: " . $sql . "<br>" . $conn->error; }

                $conn->close();
            }
            ?>
            <form action="AddUser.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <input type="submit" value="Add User">
            </form>
        </div>
    </div>
</body>
</html>