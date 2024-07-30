<?php
require_once 'dbconnection.php'; // Ensure this is included if needed

class User {
    public $username;
    public $roles = array();

    function __construct($username) {
        global $conn; // Ensure $conn is available or passed to the constructor

        $this->username = $username;

        $query = "SELECT role FROM roles WHERE username='$username'";
        $result = $conn->query($query);
        if (!$result) die($conn->error);

        $roles = array();
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row['role'];
        }

        $this->roles = $roles;
    }

    function getRoles() {
        return $this->roles;
    }
}
?>
