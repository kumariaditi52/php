<?php
session_start(); // Start the session

// Check if session variables are set
if (!isset( $_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    // Redirect to the login page
    header('Location: index.html');
    exit();
}

$admin_email = $_SESSION['user_email'];
$mechanicId = $_SESSION['user_id'];
?>
