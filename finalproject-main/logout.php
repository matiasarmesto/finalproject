<?php
session_start();

function destroy_session_and_data() {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();
}

destroy_session_and_data();

header("Location: login.php");
exit();
?>
