<?php
session_start(); // Start session to use session variables

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';  // Database connection file
    
    $tool_name = $_POST['tool_name'];
    $tool_category = $_POST['tool_category'];
    $available_quantity = $_POST['available_quantity'];
    $tool_image = $_FILES['tool_image']['name'];
    
    // Upload Tool Image
    $target_dir = "tool_images/";
    $target_file = $target_dir . basename($tool_image);
    
    $stmt = $conn->prepare("INSERT INTO tools (tool_name, tool_category, image, available_quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $tool_name, $tool_category, $tool_image, $available_quantity);
    
    if ($stmt->execute()) {
        move_uploaded_file($_FILES['tool_image']['tmp_name'], $target_file);
        $_SESSION['success_message'] = "Tool added successfully!"; // Set success message
        header("Location: admin_add_tools.php"); // Redirect back to the form
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>