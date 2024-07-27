<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT drama_id, title FROM dramas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dramas List</title>
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 8px;
        }
        a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dramas List</h1>
        <nav>
            <ul>
                <li><a href="viewdramalist.php">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="actors.php">Actors</a></li>
                <li><a onclick="return false;">Dramas</a></li>
                <li><a href="ViewUsers.php">View Users</a></li>
                <li><a href="AddUser.php">Add User</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <h2>Dramas</h2>
            <ul>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li><a href='drama_info.php?id=" . $row["drama_id"] . "'>" . $row["title"] . "</a></li>";
                    }
                } else {
                    echo "<li>No dramas found</li>";
                }
                $conn->close();
                ?>
            </ul>
        </div>
    </div>
</body>
</html>