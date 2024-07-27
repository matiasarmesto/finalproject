<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - KDrama Website</title>
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
        <h1>Welcome to KDrama Website</h1>
        <nav>
            <ul>
                <li><a onclick="return false;">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="actors.php">Actors</a></li>
                <li><a href="Dramas.php">Dramas</a></li>
                <li><a href="AddUser.php">Add User</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <h2>Explore the World of K-Dramas</h2>
            <p>Discover the latest and most popular Korean dramas, learn about your favorite actors, and purchase dramas to watch via our streaming service.</p>
            <p>
                Explore our diverse collection of dramas, showcasing the latest releases and beloved classics:
                <ul>
                    <?php
                  
                    $conn = new mysqli('localhost', 'root', 'root', 'final');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    
                    $sql = "SELECT drama_id, title FROM dramas";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<li style='margin-bottom: 8px;'><a href='drama_info.php?id=" . $row["drama_id"] . "'>" . $row["title"] . "</a></li>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </ul>
            </p>
        </div>
    </div>
</body>
</html>