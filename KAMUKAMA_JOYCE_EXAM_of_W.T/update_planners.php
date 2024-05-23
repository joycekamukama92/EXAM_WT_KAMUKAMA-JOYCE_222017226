<?php
include('db_connection.php');

// Check if Planner ID is set
if (isset($_REQUEST['planner_id'])) {
  $planner_id = $_REQUEST['planner_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM planners WHERE PlannerID=?");
  $stmt->bind_param("i", $planner_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $plannerID = $row['PlannerID'];
    $userID = $row['UserID'];
  } else {
    echo "Planner not found.";
    exit; // Exit script if planner not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Planner Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update planner information form -->
        <h2><u>Update Planner Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="userID">User ID:</label>
            <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
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

  // Update the planner in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE planners SET UserID=? WHERE PlannerID=?");
  $stmt->bind_param("ii", $userID, $planner_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: planners.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
