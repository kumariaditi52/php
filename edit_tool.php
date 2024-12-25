<?php
include 'db.php';
include 'session.php'; // Include session for authentication

$tool_id = $_GET['tool_id'];

// Fetch tool details
$tool_query = "SELECT * FROM tools WHERE id = ?";
$stmt = $conn->prepare($tool_query);
$stmt->bind_param("i", $tool_id);
$stmt->execute();
$tool_result = $stmt->get_result();
$tool = $tool_result->fetch_assoc();

$message = ""; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_quantity = $_POST['available_quantity'];

    // Update tools table with new quantity
    $update_query = "UPDATE tools SET available_quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $new_quantity, $tool_id);
    
    if ($stmt->execute()) {
        $message = "Quantity updated successfully!";
    } else {
        $message = "Error updating quantity!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tool Quantity</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 70px; /* Space below navbar */
        }

        .container {
            max-width: 600px; /* Set a max width for the form */
            margin: auto; /* Center the container */
            padding: 20px; /* Add padding */
            background-color: white; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Shadow effect */
        }

        .message {
            text-align: center;
            color: green; /* Change to red if there's an error */
        }

        label {
            display: block; /* Make labels block elements */
            margin-bottom: 10px; /* Space below labels */
            font-weight: bold; /* Bold labels */
        }

        input[type="number"] {
            width: calc(100% - 22px); /* Full width minus padding */
            padding: 10px; /* Padding inside input */
            border-radius: 5px; /* Rounded corners */
            border: 1px solid #ccc; /* Border color */
            margin-bottom: 20px; /* Space below input */
        }

        button {
            background-color: #007BFF; /* Button color */
            color: white; /* Text color */
            border: none; /* Remove border */
            padding: 10px 15px; /* Padding inside button */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }

        button:hover {
           background-color: #0056b3; /* Darker blue on hover */
       }
       
       @media (max-width: 768px) {
           h1 {
                margin-top :90px; /* Adjust for navbar height on mobile */
                font-size :24px; /* Responsive font size for header */
           }
           
           .container {
                padding :15px; /* Less padding on mobile */
           }
           
           input[type="number"], button {
                font-size :16px; /* Larger text on mobile for accessibility */
           }
       }
    </style>
</head>
<body>

<div class="navbar">
    <a href="tools.php">View Tools</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
   <h1>Edit Tool Quantity for <?php echo htmlspecialchars($tool['tool_name']); ?></h1>

   <?php if ($message): ?>
       <p class="message"><?php echo htmlspecialchars($message); ?></p>
   <?php endif; ?>

   <form method="POST">
       <label for="available_quantity">Available Quantity:</label>
       <input type="number" name="available_quantity" required min="0" value="<?php echo htmlspecialchars($tool['available_quantity']); ?>">
       
       <button type="submit">Update Quantity</button>
   </form>

   <!-- Link back to tools page -->
   <a href="tools.php">Back to Tools List</a>

</div>

<script>
    // Redirect after 5 seconds if there's a success message
    const messageElement = document.querySelector('.message');
    
    if (messageElement && messageElement.innerText.includes('successfully')) {
        setTimeout(() => {
            window.location.href = 'tools.php'; // Redirect to tools page
        }, 5000); // Delay in milliseconds (5000ms = 5 seconds)
    }
</script>

</body>
</html>