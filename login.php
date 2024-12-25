<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';  // Database connection file

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check Mechanic in DB
    $stmt = $conn->prepare("SELECT * FROM mechanics WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $mechanic = $result->fetch_assoc();
        
        // Verify password
        if ($password == $mechanic['password']) {
            session_start(); // Start a new session or resume the existing session
            $_SESSION['user_id'] = $mechanic['id']; // Store user ID in session
            $_SESSION['user_email'] = $mechanic['email']; // Store user email in session
            
            header("Location: dashboard.php"); // Redirect to dashboard
            exit(); // Ensure no further code 
            // Set session or redirect user to their dashboard
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
