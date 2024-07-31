<?php
$page_roles=array('user','admin');

require_once 'checksession.php';
require_once 'dbconnection.php';
require_once 'sanitize.php';
require_once 'header.html';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['user'];
$username = $user->username;

$query = "SELECT firstname, lastname, username FROM users WHERE username=?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $username);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_firstname = sanitize($conn, $_POST['firstname']);
    $new_lastname = sanitize($conn, $_POST['lastname']);
    $new_username = sanitize($conn, $_POST['username']);
    $new_password = sanitize($conn, $_POST['password']);
    
    if (!empty($new_password)) {
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET firstname=?, lastname=?, username=?, password=? WHERE username=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('sssss', $new_firstname, $new_lastname, $new_username, $new_password_hashed, $username);
    } else {
        $update_query = "UPDATE users SET firstname=?, lastname=?, username=? WHERE username=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ssss', $new_firstname, $new_lastname, $new_username, $username);
    }

    if ($stmt->execute()) {
        $_SESSION['user'] = new User($new_username);
        header("Location: viewdramalist.php");
        exit();
    } else {
        $error = "Error updating account: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <style>
        body {
            font-family: Trebuchet MS, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            font-weight: regular;
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
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #805cbf;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="form-box">
                <h2>Update Account</h2>
                <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
                <form action="updateaccount.php" method="post">
                    <label for="first_name">First Name</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
                    
                    <label for="last_name">Last Name</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
                    
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    
                    <label for="password">Password (leave blank to keep current password)</label>
                    <input type="password" id="password" name="password">
                    
                    <input type="submit" value="Update">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
