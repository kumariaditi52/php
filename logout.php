<?php
session_start(); // Start the session

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Return success response
header("Location: admin_login.html");
?>
