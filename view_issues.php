<?php
include 'db.php';
include 'session.php';

$sql = "SELECT i.id, m.name AS mechanic_name, t.tool_name, i.issue_date, i.return_date, i.quantity_issued
        FROM tool_issue_register i
        JOIN mechanics m ON i.mechanic_id = m.id
        JOIN tools t ON i.tool_id = t.id"; // Filter results by mechanic_id

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Register</title>
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

        @media (max-width: 768px) {
            h1 {
                margin-top :90px; /* Adjust for navbar height */
                font-size :24px; /* Responsive font size */
                }
                
                table {
                    font-size :14px; /* Smaller font size on mobile */
                }
                
                th, td {
                    padding :8px; /* Smaller padding for mobile */
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
<h1><?=  $admin_email?></h1><br>
    
    <table>
        <tr>
            <th>Mechanic Name</th>
            <th>Tool Name</th>
            <th>Quantity Issued</th>
            <th>Issue Date</th>
            <th>Return Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['mechanic_name']); ?></td>
            <td><?php echo htmlspecialchars($row['tool_name']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity_issued']); ?></td>
            <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
            <td><?php echo ($row['return_date'] ? htmlspecialchars($row['return_date']) : 'Not returned'); ?></td>
            
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>