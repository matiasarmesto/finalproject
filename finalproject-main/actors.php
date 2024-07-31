<?php
include('dbconnection.php'); 
include('header.html'); // Include the header at the top

$conn = new mysqli($hn, $un, $pw, $db); // Ensure the connection is established

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM actors";
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actors</title>
    <style>
        body {
            font-family: Trebuchet MS, sans-serif;
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
        }
        .actors-list {
            list-style-type: none;
            padding: 0;
        }
        .actor-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Actors</h1>
            <?php if ($result->num_rows > 0): ?>
                <ul class="actors-list">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="actor-item">
                            <h2><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h2>
                            <p>Date of Birth: <?php echo htmlspecialchars($row['date_of_birth']); ?></p>
                            <!-- Add more actor details here if needed -->
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No actors found</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
