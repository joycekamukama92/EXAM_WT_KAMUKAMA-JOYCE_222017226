<?php
include('db_connection.php');

// Check if Goal ID is set
if (isset($_REQUEST['goal_id'])) {
  $goal_id = $_REQUEST['goal_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM goals WHERE GoalID=?");
  $stmt->bind_param("i", $goal_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $goalID = $row['GoalID'];
    $userID = $row['UserID'];
    $goalText = $row['GoalText'];
    $deadline = $row['Deadline'];
  } else {
    echo "Goal not found.";
    exit; // Exit script if goal not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Goal Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update goal information form -->
        <h2><u>Update Goal Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="userID">User ID:</label>
            <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
            <br><br>

            <label for="goalText">Goal Text:</label>
            <input type="text" name="goalText" value="<?php echo isset($goalText) ? $goalText : ''; ?>">
            <br><br>

            <label for="deadline">Deadline:</label>
            <input type="text" name="deadline" value="<?php echo isset($deadline) ? $deadline : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $userID = $_POST['userID'];
  $goalText = $_POST['goalText'];
  $deadline = $_POST['deadline'];

  // Update the goal in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE goals SET UserID=?, GoalText=?, Deadline=? WHERE GoalID=?");
  $stmt->bind_param("issi", $userID, $goalText, $deadline, $goal_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: goals.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
