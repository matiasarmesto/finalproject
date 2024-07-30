<?php
$page_roles=array('user','admin');
session_start();
require_once 'dbconnection.php';
require_once 'header.html';
//require_once 'checksession.php';
require_once 'user.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid actor ID.");
}

$actor_id = intval($_GET['id']); // Sanitize the input

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT actor_id, first_name, last_name, imagep, date_of_birth FROM actors WHERE actor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $actor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No actor found with that ID.");
}

$actor = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actor Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .content {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .actor-image {
            max-width: 300px;
            border-radius: 5px;
        }
        .actor-info h1 {
            font-family: 'Arsenal', sans-serif;
            font-weight: 700;
            font-style: italic;
            color: #333;
        }
        .actor-info p {
            margin: 10px 0;
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
            <div class="actor-info">
                <h1><?php echo htmlspecialchars($actor['last_name'] . ' ' . $actor['first_name']); ?></h1>
                <img src="<?php echo htmlspecialchars($actor['imagep']); ?>" alt="<?php echo htmlspecialchars($actor['first_name'] . ' ' . $actor['last_name']); ?>" class="actor-image">
                <p>Date of Birth: <?php echo htmlspecialchars($actor['date_of_birth']); ?></p>
            </div>
            <a href="updateactor.php?id=<?php echo $actor['actor_id']; ?>" class="btn">Update Actor Info</a>
        </div>
    </div>
</body>
</html>
