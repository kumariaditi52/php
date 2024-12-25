<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';  // Database connection file
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    
    // Image Upload
    $picture = $_FILES['picture']['name'];
    $target_dir = "profile/";
    $target_file = $target_dir . basename($picture);
    
    // Validate Email and Mobile
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
    
    if (strlen($mobile_no) != 10 || !ctype_digit($mobile_no)) {
        die("Invalid mobile number");
    }
    
    // Password Validation
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
        die("Password must contain at least 8 characters, a number, a special character.");
    }
    
    // Encrypt Password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check for unique email and mobile number
    $check_query = "SELECT * FROM mechanics WHERE email='$email' OR mobile_no='$mobile_no'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        die("Email or Mobile Number already registered.");
    }
    
    // Insert Mechanic into Database
    $insert_query = "INSERT INTO mechanics (name, email, mobile_no, password, picture, level) 
                     VALUES ('$name', '$email', '$mobile_no', '$password', '$picture', '$level')";
    
    if (mysqli_query($conn, $insert_query)) {
        move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);
        header("Location: index.html"); // Redirect to dashboard
            exit(); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
