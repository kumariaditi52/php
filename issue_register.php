<?php
include 'db.php';
include 'mechanicSession.php';

// Modify the query to filter by the mechanic's ID
$sql = "SELECT i.id, m.name AS mechanic_name, t.tool_name,i.tool_id, i.issue_date, i.return_date, i.quantity_issued
        FROM tool_issue_register i
        JOIN mechanics m ON i.mechanic_id = m.id
        JOIN tools t ON i.tool_id = t.id
        WHERE i.mechanic_id = '$mechanicId'"; // Filter results by mechanic_id// Filter results by mechanic_id

$result = mysqli_query($conn, $sql);

// Check if any rows were returned
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
            margin-top: 70px;
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
                margin-top: 90px;
                font-size: 24px;
            }
            
            table {
                font-size: 14px;
            }
            
            th, td {
                padding: 8px;
            }
        }
        .return-button {
    background-color: #28a745; /* Green color */
    color: white;
    border: none;
    padding: 10px 20px; /* Increased padding for a larger button */
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for hover */
    font-size: 16px; /* Font size for the text */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Light shadow */
}

.return-button:hover {
    background-color: #218838; /* Darker green on hover */
    transform: scale(1.05); /* Slightly enlarges the button on hover */
}

.return-button:active {
    background-color: #1e7e34; /* Even darker green when clicked */
    transform: scale(0.95); /* Slightly shrinks when clicked */
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
    <a href="dashboard.php">Home</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php $firstRow = mysqli_fetch_assoc($result); ?>
        
        <h1><?php echo htmlspecialchars($firstRow['mechanic_name']); ?></h1>

        <table>
            <tr>
                <th>Tool Name</th>
                <th>Quantity Issued</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>

            <!-- Display the first row's data -->
            <tr>
                <td><?php echo htmlspecialchars($firstRow['tool_name']); ?></td>
                <td><?php echo htmlspecialchars($firstRow['quantity_issued']); ?></td>
                <td><?php echo htmlspecialchars($firstRow['issue_date']); ?></td>
                <td><?php echo ($firstRow['return_date'] ? htmlspecialchars($firstRow['return_date']) : 'Not returned'); ?></td>
                <td>
                    <?php if (!$firstRow['return_date']): ?>
                        <form method="POST" action="return_tool.php">
                            <input type="hidden" name="issue_id" value="<?php echo $firstRow['id']; ?>">
                            <input type="hidden" name="tool_id" value="<?php echo $firstRow['tool_id']; ?>">
                            <input type="hidden" name="quantity_issued" value="<?php echo $firstRow['quantity_issued']; ?>">
                            <button type="submit" class="return-button">Return</button>
<!-- Styled return button -->
                        </form>
                    <?php else: ?>
                        Returned
                    <?php endif; ?>
                </td>
            </tr>

            <!-- Loop through the remaining rows -->
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tool_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity_issued']); ?></td>
                    <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
                    <td><?php echo ($row['return_date'] ? htmlspecialchars($row['return_date']) : 'Not returned'); ?></td>
                    <td>
                        <?php if (!$row['return_date']): ?>
                            <form method="POST" action="return_tool.php">
                                <input type="hidden" name="issue_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="tool_id" value="<?php echo $row['tool_id']; ?>">
                                <input type="hidden" name="quantity_issued" value="<?php echo $row['quantity_issued']; ?>">
                                <button type="submit" class="return-button">Return</button>
                            </form>
                        <?php else: ?>
                            Returned
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    <?php else: ?>
        <h1>No records found for the mechanic.</h1>
    <?php endif; ?>
</div>

</body>
</html>
