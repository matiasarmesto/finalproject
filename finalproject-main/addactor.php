<?php
$page_roles=array('admin');

require_once 'dbconnection.php';
require_once 'header.html';
require_once 'checksession.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $imagep = $_POST['imagep'];

    // Validate input
    if (empty($last_name) || empty($first_name) || empty($date_of_birth) || empty($imagep)) {
        $error_message = "All fields are required.";
    } else {
        $conn = new mysqli($hn, $un, $pw, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO actors (last_name, first_name, date_of_birth, imagep) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $last_name, $first_name, $date_of_birth, $imagep);

        if ($stmt->execute()) {
            $success_message = "Actor added successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Actor</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #805cbf;
        }
        .message {
            margin-bottom: 15px;
            font-weight: bold;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Add New Actor</h2>
            <?php if (isset($error_message)): ?>
                <p class="message error"><?php echo htmlspecialchars($error_message); ?></p>
            <?php elseif (isset($success_message)): ?>
                <p class="message success"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
            <form action="addactor.php" method="post">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="imagepath">Image Path</label>
                    <input type="text" id="imagep" name="imagep" required>
                </div>
                <button type="submit" class="btn">Add Actor</button>
                <a href="actors.php" class="btn btn-back">Back to Actor List</a>
            </form>
        </div>
    </div>
</body>
</html>
