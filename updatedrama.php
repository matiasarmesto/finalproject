<?php
require_once 'dbconnection.php'; 
require_once 'header.html';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $drama_id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $conn->real_escape_string($_POST['title']);
        $description = $conn->real_escape_string($_POST['description']);
        $release_date = $conn->real_escape_string($_POST['release_date']);
        $genre = $conn->real_escape_string($_POST['genre']);
        $rating = $conn->real_escape_string($_POST['rating']);

        $update_query = "UPDATE dramas SET title='$title', description='$description', release_date='$release_date', genre='$genre', rating='$rating' WHERE drama_id=$drama_id";
        
        if ($conn->query($update_query) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $query = "SELECT * FROM dramas WHERE drama_id = $drama_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("No data found for the specified drama ID.");
    }
} else {
    die("No drama ID specified.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Drama - <?php echo htmlspecialchars($row['title']); ?></title>
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
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            height: 100px;
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
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #805cbf;
        }
        .btn-back {
            background-color: #333;
        }
        .btn-back:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Drama - <?php echo htmlspecialchars($row['title']); ?></h1>
        <div class="content">
            <form action="updatedrama.php?id=<?php echo htmlspecialchars($drama_id); ?>" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="synopsis">Synopsis</label>
                    <textarea id="text" name="synopsis" required><?php echo htmlspecialchars($row['synopsis']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" id="release_date" name="release_date" value="<?php echo htmlspecialchars($row['release_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($row['genre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" id="rating" name="rating" value="<?php echo htmlspecialchars($row['rating']); ?>" required>
                </div>
                <button type="submit" class="btn">Update Drama</button>
            </form>
            <a href="viewdramalist.php" class="btn btn-back">Back to K-Drama List</a>
            <form action="deletedrama.php" method="post" style="display:inline;">
            <input type="hidden" name="drama_id" value="<?php echo htmlspecialchars($row['drama_id']); ?>">
            <input type="submit" class="btn btn-delete" value="Delete Drama" onclick="return confirm('Are you sure you want to delete this drama?');">
        </form>
        </div>
    </div>
</body>
</html>
