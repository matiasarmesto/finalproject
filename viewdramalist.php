<?php
$page_roles=array('user','admin');

require_once 'dbconnection.php';
require_once 'header.html';
require_once 'checksession.php';
//require_once 'user.php';


$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT drama_id, title, imagepath FROM dramas";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - KDrama Website</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Trebuchet MS, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            font-weight: Regular 400;
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
        .drama-container {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .drama-container img {
            max-width: 200px;
            margin-right: 15px;
            border-radius: 5px;
        }
        .drama-container a {
            text-decoration: none;
            font-family: 'Bebas Neue', sans-serif;
            color: #333;
            font-size: 33px;
            font-weight: 400;
            font-style: normal;
        }
        .drama-container a:hover {
            text-decoration: underline;
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
        .no-results {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <a href="adddrama.php" class="btn">Add K-Drama</a>
            <h2>Explore the World of K-Dramas</h2>
            <p>Discover the latest and most popular Korean dramas, learn about your favorite actors, and purchase dramas to watch via our streaming service.</p>
            <p>
                Explore our diverse collection of dramas, showcasing the latest releases and beloved classics:
            </p>
            <ul>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='drama-container'>";
                        echo "<img src='" . htmlspecialchars($row["imagepath"]) . "' alt='" . htmlspecialchars($row["title"]) . " image'>";
                        echo "<a href='dramadetails.php?drama_id=" . $row["drama_id"] . "'>" . htmlspecialchars($row["title"]) . "</a>";
                        echo "</li>";
                    }
                } else {
                    echo "<li class='no-results'>No results found</li>";
                }
                $conn->close();
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
