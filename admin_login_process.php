<?php
session_start(); // Start session at the beginning

include "db.php"; // Include database connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize user inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Password should not be sanitized with mysqli_real_escape_string

    // Regular SQL query (not recommended for production)
    $sql = "SELECT * FROM admins WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if an admin with the provided email exists
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        // echo $admin['password'] . '<br>';
        // echo $admin['email'] . '<br>';
        // echo  $password . '<br>';
        // echo   $email;
        // Verify the password
        if ($admin['password'] == $password) {
            $_SESSION['admin_email'] = $admin['username']; // Store email in session
            header("Location: admin_add_tool.php"); // Redirect to dashboard
            exit(); 
        } else {
            echo "Invalid admin credentials."; // Invalid password
        }
    } else {
        echo "Invalid admin credentials."; // Admin not found
    }

    // Free result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);
?>