<?php
require_once 'dbconnection.php';
require_once 'header.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
            cursor: pointer;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Update User</h1>
        <nav>
            <ul>
                <li><a href="viewdramalist.php">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="actors.php">Actors</a></li>
                <li><a href="ViewUsers.php">View Users</a></li>
                <li><a href="AddUser.php">Add User</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <h2>Update User</h2>
<?php
            $conn = new mysqli($hn, $un, $pw, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT username, email FROM users WHERE id=$id";
                $result = $conn->query($sql);
                $user = $result->fetch_assoc();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];
                $username = $_POST['username'];
                $email = $_POST['email'];

                $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "User updated successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
                header('Location: ViewUsers.php');
            }
?>
            <form action="UpdateUser.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                <br>
                <input type="submit" value="Update User">
            </form>
        </div>
    </div>
</body>
</html>