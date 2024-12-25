<?php
include "session.php";
include 'db.php';  // Database connection file

$result = $conn->query("SELECT * FROM tools");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tools</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            border-radius: 5px; /* Rounded corners for images */
        }
        .container {
            max-width: 1200px;
            margin: auto;
            margin-top:20px;
            background: white;
            padding: 20px;
            border-radius: 8px; /* Rounded corners for container */
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
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

        .edit-button {
            background-color: #007BFF; /* Button color */
            color: white; /* Text color */
            border: none; /* Remove border */
            padding: 5px 10px; /* Padding inside button */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
        }

        .edit-button:hover {
           background-color :#0056b3; /* Darker blue on hover */
       }
    </style>
</head>
<body>
<div class="navbar">
    <a href="admin_add_tool.php">Add Tools</a>
    <a href="view_issues.php">Issues Tools</a>
    <a href="logout.php">Logout</a>
</div>
<div class="container">
    <h2>Available Tools</h2>
    <table>
        <tr>
            <th>Tool Name</th>
            <th>Tool Category</th>
            <th>Image</th>
            <th>Available Quantity</th>
            <th>Action</th> <!-- New column for actions -->
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['tool_name']); ?></td>
            <td><?php echo htmlspecialchars($row['tool_category']); ?></td>
            <td><img src='tool_images/<?php echo htmlspecialchars($row['image']); ?>' alt='<?php echo htmlspecialchars($row['tool_name']); ?>' width='100'></td>
            <td><?php echo htmlspecialchars($row['available_quantity']); ?></td>
            
           <!-- Edit button -->
           <td><a href="edit_tool.php?tool_id=<?php echo $row['id']; ?>" class="edit-button">Edit</a></td> 
           
        </tr>
        <?php endwhile; ?>
        
    </table>
</div>

</body>
</html>