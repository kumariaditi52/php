<?php
include 'db.php';
include 'mechanicSession.php';

$sql = "SELECT * FROM tools";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tools</title>
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
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 5px;
        }

        .action-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .action-btn:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .navbar a {
                float: none; /* Stack links on smaller screens */
                text-align: left; /* Align text to the left */
                padding-left: 20px; /* Add padding */
                padding-right: 20px; /* Add padding */
                display:block; /* Make them block elements */
                width:auto; /* Auto width for links */
                border-bottom :1px solid #ddd; /* Add border between links */
                margin-bottom :10px; /* Space between links */
                }
                
                h1 {
                    margin-top :90px; /* Adjust for navbar height */
                }
                
                table {
                    font-size :14px; /* Smaller font size on mobile */
                }
                
                img {
                    width :80%; /* Responsive image size */
                    height:auto; /* Maintain aspect ratio */
                }
                
                th, td {
                    padding :8px; /* Smaller padding for mobile */
                }
                
                .action-btn {
                    font-size :14px; /* Smaller button size on mobile */
                    padding :6px; /* Smaller button padding on mobile */
                }
                
                tr:hover {
                    background-color :#e7e7e7; /* Change hover color on mobile */
                }
         }

 
    </style>
</head>
<body>

<div class="navbar">
    <a href="issue_register.php">Issues Tools</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h1>Available Tools</h1>
    <table>
        <tr>
            <th>Tool Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Available Quantity</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['tool_name']); ?></td>
            <td><?php echo htmlspecialchars($row['tool_category']); ?></td>
            <td><img src='tool_images/<?php echo htmlspecialchars($row['image']); ?>' width='100' alt='<?php echo htmlspecialchars($row['tool_name']); ?>'></td>
            <td><?php echo htmlspecialchars($row['available_quantity']); ?></td>
            <td><a class='action-btn' href='issue_tool.php?tool_id=<?php echo $row['id']; ?>'>Issue Tool</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>