<?php
$page_roles = array('admin');

require_once 'dbconnection.php'; 
require_once 'header.html';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $drama_id = intval($_GET['id']);
    echo "Drama ID: " . $drama_id . "<br>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Update drama details
        $title = $conn->real_escape_string($_POST['title']);
        $synopsis = $conn->real_escape_string($_POST['synopsis']);
        $release_date = $conn->real_escape_string($_POST['release_date']);
        $genre = $conn->real_escape_string($_POST['genre']);
        $rating = $conn->real_escape_string($_POST['rating']);
        $director_firstname = $conn->real_escape_string($_POST['director_firstname']);
        $director_lastname = $conn->real_escape_string($_POST['director_lastname']);
        
        // Update the drama table
        $update_query = "UPDATE dramas 
                         SET title='$title', synopsis='$synopsis', release_date='$release_date', genre='$genre', rating='$rating' 
                         WHERE drama_id=$drama_id";
        
        if ($conn->query($update_query) === TRUE) {
            echo "Drama details updated successfully<br>";
        } else {
            echo "Error updating drama details: " . $conn->error;
        }

        // Update the director
        $director_query = "INSERT INTO director (firstname, lastname) VALUES ('$director_firstname', '$director_lastname') 
                           ON DUPLICATE KEY UPDATE firstname='$director_firstname', lastname='$director_lastname'";
        
        if ($conn->query($director_query) === TRUE) {
            $director_id = $conn->insert_id;
            $update_director_query = "UPDATE dramas SET directorID=$director_id WHERE drama_id=$drama_id";
            $conn->query($update_director_query);
            echo "Director updated successfully<br>";
        } else {
            echo "Error updating director: " . $conn->error;
        }

        // Update awards
        $selected_awards = $_POST['awards'] ?? [];

        // Clear current awards
        $delete_awards_query = "DELETE FROM drama_awards WHERE drama_id = $drama_id";
        $conn->query($delete_awards_query);

        // Insert new awards
        foreach ($selected_awards as $award_id) {
            $award_id = intval($award_id);
            $insert_award_query = "INSERT INTO drama_awards (drama_id, awardID) VALUES ($drama_id, $award_id)";
            $conn->query($insert_award_query);
        }

        echo "Awards updated successfully";
    }

    // Fetch current drama details
    $query = "SELECT d.*, dir.firstname AS director_firstname, dir.lastname AS director_lastname 
              FROM dramas d 
              LEFT JOIN director dir ON d.directorID = dir.directorID 
              WHERE d.drama_id = $drama_id";
    $result = $conn->query($query);

    if (!$result) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("No data found for the specified drama ID.");
    }

    // Fetch current awards for the drama
    $awards_query = "SELECT a.awardID, a.award_name FROM awards a 
                     JOIN drama_awards da ON a.awardID = da.awardID 
                     WHERE da.drama_id = $drama_id";
    $awards_result = $conn->query($awards_query);

    $current_awards = [];
    if ($awards_result && $awards_result->num_rows > 0) {
        while ($award = $awards_result->fetch_assoc()) {
            $current_awards[] = $award['awardID'];
        }
    }

    // Fetch all awards for selection
    $all_awards_query = "SELECT * FROM awards";
    $all_awards_result = $conn->query($all_awards_query);
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
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
                    <textarea id="synopsis" name="synopsis" required><?php echo htmlspecialchars($row['synopsis']); ?></textarea>
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
                <div class="form-group">
                    <label for="director_firstname">Director First Name</label>
                    <input type="text" id="director_firstname" name="director_firstname" value="<?php echo htmlspecialchars($row['director_firstname']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="director_lastname">Director Last Name</label>
                    <input type="text" id="director_lastname" name="director_lastname" value="<?php echo htmlspecialchars($row['director_lastname']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="awards">Awards</label>
                    <select id="awards" name="awards[]" multiple>
                        <?php
                        while ($award = $all_awards_result->fetch_assoc()) {
                            $selected = in_array($award['awardID'], $current_awards) ? 'selected' : '';
                            echo "<option value='" . $award['awardID'] . "' $selected>" . htmlspecialchars($award['award_name']) . "</option>";
                        }
                        ?>
                    </select>
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
