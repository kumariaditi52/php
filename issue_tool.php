<?php
include 'db.php';
include 'mechanicSession.php';
$tool_id = $_GET['tool_id'];

// Initialize message variable
$message = "";

// Fetch tool details
$tool_query = "SELECT * FROM tools WHERE id = ?";
$stmt = $conn->prepare($tool_query);
$stmt->bind_param("i", $tool_id);
$stmt->execute();
$tool_result = $stmt->get_result();
$tool = $tool_result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];

    // Check if enough quantity is available
    if ($tool['available_quantity'] >= $quantity) {
        // Update tools table
        $new_quantity = $tool['available_quantity'] - $quantity;
        $update_query = "UPDATE tools SET available_quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $new_quantity, $tool_id);
        $stmt->execute();

        // Insert into issued_tools table
        $issue_query = "INSERT INTO tool_issue_register (mechanic_id, tool_id, issue_date, quantity_issued) VALUES (?, ?, NOW(), ?)";
        $stmt = $conn->prepare($issue_query);
        $stmt->bind_param("iii", $mechanicId, $tool_id, $quantity);
        $stmt->execute();

        // Set success message
        $message = "Tool issued successfully!";
    } else {
        // Set error message
        $message = "Not enough quantity available!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Tool</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow effect */
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

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007BFF; /* Blue background for toast */
            color: white; /* White text color */
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            opacity: 0; /* Initially hidden */
            transition: opacity 0.5s ease-in-out; /* Fade in/out effect */
        }
        
        .show {
           opacity :1; /* Show the toast when this class is added */ 
       }
        
       @media (max-width :768px) {
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
<a href="dashboard.php">Home</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h1>Issue Tool: <?php echo htmlspecialchars($tool['tool_name']); ?></h1>
    
    <form method="POST">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required min="1" max="<?php echo htmlspecialchars($tool['available_quantity']); ?>">
        
        <button type="submit">Issue Tool</button>
    </form>
</div>

<!-- Toast Notification -->
<div id="toast" class="toast"><?php echo htmlspecialchars($message); ?></div>

<script>
    // Show toast if there is a message
    const toastMessage = "<?php echo addslashes($message); ?>";
    const toastElement = document.getElementById('toast');

    if (toastMessage) {
       toastElement.innerText = toastMessage;
       toastElement.classList.add('show'); // Add show class to make it visible

       // Hide the toast after a few seconds
       setTimeout(() => {
           toastElement.classList.remove('show'); // Remove show class to hide it
       }, 3000); // Toast will disappear after 3 seconds
   }
</script>

</body>
</html>