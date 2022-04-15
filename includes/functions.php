<?php 
// Check if a user is connected
function isUserConnected() {
    return isset($_SESSION['login']);
}

function administratorIsUserConnected() {
    return $_SESSION['role']=="Admin";
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}
?>