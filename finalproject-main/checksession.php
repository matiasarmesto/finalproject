<?php

require_once 'user.php'; // Ensure this file includes the User class definition

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    error_log("Session data is not a User object. Type: " . gettype($_SESSION['user']));
    header("Location: login.php");
    exit();
}

// Retrieve user and roles
$user = $_SESSION['user'];
$user_roles = $user->getRoles();
$username = $user->username;

// Define or retrieve $page_roles
//$page_roles = ['user', 'admin'];
$found = false;

// Check if user has one of the required roles
foreach ($user_roles as $urole) {
    if (in_array($urole, $page_roles)) {
        $found = true;
        break;
    }
}

if (!$found) {
    error_log("User $username does not have appropriate roles, unauthorized entry");
    echo "Unauthorized entry";
    exit();
} else {
    error_log("User $username has appropriate roles, access granted");
}
?>
