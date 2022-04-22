<?php 
// Check if a user is connected
function isUserConnected() {
    return isset($_SESSION['role']);
}

function administratorIsUserConnected() {
    if($_SESSION['role']=="admin")
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}
?>