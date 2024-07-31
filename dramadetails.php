<?php
$page_roles=array('user','admin');

require_once 'dbconnection.php'; 
require_once 'header.html';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['drama_id'])) {
    $drama_id = $_GET['drama_id'];

    // Query to get drama details and its awards
    $query = "
        SELECT d.*, GROUP_CONCAT(a.award_name SEPARATOR ', ') AS awards
        FROM dramas d
        LEFT JOIN drama_awards da ON d.drama_id = da.drama_id
        LEFT JOIN awards a ON da.awardID = a.awardID
        WHERE d.drama_id = ?
        GROUP BY d.drama_id
    ";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $drama_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result) {
            die($conn->error);
        }

        $row = $result->fetch_assoc();
        if (!$row) {
            die("No data found for the specified drama ID.");
        }
        
        $stmt->close();
    } else {
        die("Error preparing statement: " . $conn->error);
    }
} else {
    die("No drama ID provided.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><strong>Details - <?php echo htmlspecialchars($row['title']); ?></strong></title>
    <style>
        body {
            font-family: Trebuchet MS, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        header {
            background: #9370Db;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-family: 'Arsenal', sans-serif;
            font-weight: 700;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            position: relative;
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
        .drama-details {
            flex: 1;
        }
        .drama-details h2 {
            margin-top: 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #9370Db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            background-color: #805cbf;
        }
        .btn-update {
            background-color: #333;
        }
        .btn-update:hover {
            background-color: #555;
        }
        .no-results {
            color: #ff0000;
        }
        .btn-add_to_cart {
            display: inline-block;
            padding: 10px 20px;
            background-color: pink;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            right: 20px;
            text-align: center;
        }
        .btn-purchase:hover {
            background-color: #ff69b4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><strong>Details -</strong></h1>
        <div class="drama-container">
            <img src="<?php echo htmlspecialchars($row['imagepath']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
            <div class="drama-details">
                <h2><strong><?php echo htmlspecialchars($row['title']); ?></strong></h2>
                <p><strong>Synopsis:</strong> <?php echo htmlspecialchars($row['synopsis']); ?></p>
                <p><strong>Release Date:</strong> <?php echo htmlspecialchars($row['release_date']); ?></p>
                <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                <p><strong>Rating:</strong> <?php echo htmlspecialchars($row['rating']); ?></p>
                <p><strong>Awards:</strong> <?php echo htmlspecialchars($row['awards']) ?: 'No awards received'; ?></p>
            </div>
        </div>
        <a href="viewdramalist.php" class="btn">Back to K-Drama List</a>
        <a href="updatedrama.php?id=<?php echo htmlspecialchars($row['drama_id']); ?>" class="btn btn-update">Update Details</a>
        <a href="add-to-cart.php?drama_id=<?php echo htmlspecialchars($row['drama_id']); ?>" class="btn btn-add_to_cart">Add to Cart</a>
    </div>
</body>
</html>
