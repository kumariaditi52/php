<?php
session_start(); // Start the session

// Check if session variables are set
if (!isset($_SESSION['admin_email'])) {
    // Redirect to the login page
    header('Location: admin_login.html');
    exit();
}

$admin_email = $_SESSION['admin_email'];
?>
