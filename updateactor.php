<?php
$page_roles=array('admin');

require_once 'dbconnection.php';
require_once 'header.html';
require_once "checksession.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid actor ID.");
}

$actor_id = (int)$_GET['id'];
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current actor details
$sql = "SELECT first_name, last_name, date_of_birth, imagep FROM actors WHERE actor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $actor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Actor not found.");
}

$actor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $imagep = $_POST['imagep'];

    // Update actor details
    $sql = "UPDATE actors SET first_name = ?, last_name = ?, date_of_birth = ?, imagep = ? WHERE actor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $first_name, $last_name, $date_of_birth, $imagep, $actor_id);
    $stmt->execute();

    echo "<p>Actor updated successfully.</p>";
}

if (isset($_POST['delete'])) {
    // Delete actor
    $sql = "DELETE FROM actors WHERE actor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $actor_id);
    $stmt->execute();

    echo "<p>Actor deleted successfully.</p>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Actor</title>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@1,700&display=swap" rel="stylesheet">
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
        .btn-delete {
            background-color: #9370Db;
        }
        .btn-delete:hover {
            background-color: #6a5acd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Update Actor</h1>
            <form method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($actor['first_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($actor['last_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($actor['date_of_birth']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="imagep">Image Path:</label>
                    <input type="text" id="imagep" name="imagep" value="<?php echo htmlspecialchars($actor['imagep']); ?>" required>
                </div>
                <input type="submit" value="Update Actor" class="btn">
                <input type="submit" name="delete" value="Delete Actor" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this actor?');">
            </form>
        </div>
    </div>
</body>
</html>
