<?php
require_once 'dbconnection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $synopsis = $_POST['synopsis'];
    $release_date = $_POST['release_date'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO dramas (title, synopsis, release_date, genre, rating, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssd', $title, $synopsis, $release_date, $genre, $rating, $price);
    $stmt->execute();
    $stmt->close();

    echo "Drama added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Drama</title>
</head>
<body>
    <h1>Add Drama</h1>
    <form action="add-drama.php" method="post">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="synopsis">Synopsis</label>
        <input type="text" id="synopsis" name="synopsis" required>

        <label for="release_date">Release Date</label>
        <input type="date" id="release_date" name="release_date" required>

        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" required>

        <label for="rating">Rating</label>
        <input type="text" id="rating" name="rating" required>

        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <input type="submit" value="Add Drama">
    </form>
</body>
</html>
