<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tool</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
            font-weight: bold;
        }

        input[type="text"], 
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .success-message {
            background-color: #d4edda; /* Light green background */
            color: #155724; /* Dark green text */
            padding: 10px; 
            margin-bottom: 15px; 
            border-radius: 5px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Tool</h2>

        <?php
        // Display success message if it exists
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message'>" . htmlspecialchars($_SESSION['success_message']) . "</div>";
            unset($_SESSION['success_message']); // Clear the message after displaying
        }
        ?>

        <form action="add_tool.php" method="POST" enctype="multipart/form-data">
            <label for="tool_name">Tool Name</label>
            <input type="text" id="tool_name" name="tool_name" required>

            <label for="tool_category">Tool Category</label>
            <input type="text" id="tool_category" name="tool_category" required>

            <label for="tool_image">Tool Image</label>
            <input type="file" id="tool_image" name="tool_image" required>

            <label for="available_quantity">Available Quantity</label>
            <input type="number" id="available_quantity" name="available_quantity" required>

            <button type="submit">Add Tool</button>
        </form>
    </div>
</body>
</html>