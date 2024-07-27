<?php

$servername = "localhost";
$username = 'root';
$password = '';
$dbname = 'final';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$drama_id = intval($_GET['id']);


$sql = "SELECT * FROM dramas WHERE drama_id = $drama_id";
$result = $conn->query($sql);
$drama = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $drama['title']; ?> - KDrama Website</title>
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
        <h1><?php echo $drama['title']; ?></h1>
        <nav>
            <ul>
                <li><a href="viewdramalist.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="actors.php">Actors</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <h2><?php echo $drama['title']; ?></h2>
            <p><strong>Release Date:</strong> <?php echo $drama['release_date']; ?></p>
            <p><strong>Genre:</strong> <?php echo $drama['genre']; ?></p>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>