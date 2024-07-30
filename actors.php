<?php

session_start();
require_once 'dbconnection.php';
require_once 'header.html';
//require_once 'checksession.php';
$page_roles=array('user','admin');

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT actor_id, first_name, last_name, imagep, date_of_birth FROM actors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actors List</title>
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 20px;
        
        }
        .actor-container {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .actor-image {
            max-width: 200px;
            max-height: 200px;
            margin-right: 15px;
            border-radius: 5px;
        }
        .actor-info {
            display: flex;
            flex-direction: column;
        }
        .actor-info a {
            text-decoration: none;
            color: #000;
            font-size: 18px;
            font-weight: bold;
        }
        .actor-info p {
            margin: 5px 0;
            color: #555;
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
        	<a href="addactor.php" class="btn">Add Actor</a>
            <ul>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li class='actor-container'>";
                        echo "<img src='" . htmlspecialchars($row["imagep"]) . "' alt='" . htmlspecialchars($row["last_name"] . " " . $row["first_name"]) . "' class='actor-image'>";
                        echo "<div class='actor-info'>";
                        echo "<a href='actor_info.php?id=" . $row["actor_id"] . "'>" . htmlspecialchars($row["last_name"] . " " . $row["first_name"]) . "</a>";
                        echo "<p>Date of Birth: " . htmlspecialchars($row["date_of_birth"]) . "</p>";
                        echo "</div>";
                        echo "</li>";
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
