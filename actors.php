<?php
require_once 'dbconnection.php';
require_once 'header.html';

$conn = new mysqli($hn, $un, $pw, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT actor_id, first_name, last_name FROM actors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actors List</title>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@1,700&display=swap" rel="stylesheet">
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
        h1 {
        	font-family: 'Arsenal', sans-serif;
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
    </header>
    <div class="container">
        <div class="content">
            <h1>Actors</h1>
            <ul>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li><a href='actor_info.php?id=" . $row["actor_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</a></li>";
                    }
                } else {
                    echo "<li>No actors found</li>";
                }
                $conn->close();
                ?>
            </ul>
        </div>
    </div>
</body>
</html>