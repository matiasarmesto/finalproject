<?php
require_once 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $imagepath = $conn->real_escape_string($_POST['imagepath']);
    $genre = $conn->real_escape_string($_POST['genre']);
    $description = $conn->real_escape_string($_POST['description']);
    $release_date = $conn->real_escape_string($_POST['release_date']);
    $rating = $conn->real_escape_string($_POST['rating']);

    $query = "INSERT INTO dramas (title, imagepath, genre, description, release_date, rating) 
              VALUES ('$title', '$imagepath', '$genre', '$description', '$release_date', '$rating')";

    if ($conn->query($query) === TRUE) {
        header("Location: viewdramalist.php?message=Drama added successfully");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add K-Drama - KDrama Project</title>
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
        .form-box {
            background: #fff;
            padding: 20px;
            margin: 50px auto;
            box-shadow: 0px 0px 10px 0px #000;
            max-width: 500px;
            width: 100%; 
        }
        .form-box label {
            display: block;
            margin-bottom: 8px;
        }
        .form-box input[type="text"],
        .form-box input[type="date"],
        .form-box input[type="submit"],
        .form-box textarea {
            width: 100%;
            padding: 8px; 
            margin-bottom: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box; 
        }
        .form-box input[type="submit"] {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-box input[type="submit"]:hover {
            background: #555;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Add New K-Drama</h2>
            <form action="adddrama.php" method="post" class="form-box">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
                
                <label for="imagepath">Image Path</label>
                <input type="text" id="imagepath" name="imagepath" required>
                
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" required>
                
                <label for="description">Synopsis</label>
                <textarea id="description" name="description" required></textarea>
                
                <label for="release_date">Release Date</label>
                <input type="date" id="release_date" name="release_date" required>
                
                <label for="rating">Rating</label>
                <input type="text" id="rating" name="rating" required>
                
                <input type="submit" value="Add Drama">
            </form>
            <a href="viewdramalist.php" class="btn">Back to K-Drama List</a>
        </div>
    </div>
</body>
</html>
