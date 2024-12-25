<?php
include 'db.php';

// Get the posted data
$issue_id = $_POST['issue_id'];
$tool_id = $_POST['tool_id'];
$quantity_issued = $_POST['quantity_issued'];

// Update the return date in tool_issue_register
$updateIssue = "UPDATE tool_issue_register SET return_date = NOW() WHERE id = '$issue_id'";
mysqli_query($conn, $updateIssue);

// Update the quantity in tools by adding the issued quantity back
$updateTools = "UPDATE tools SET available_quantity = available_quantity + '$quantity_issued' WHERE id = '$tool_id'";
mysqli_query($conn, $updateTools);

// Redirect back to the issue register page
header("Location: issue_register.php");
exit();
?>
