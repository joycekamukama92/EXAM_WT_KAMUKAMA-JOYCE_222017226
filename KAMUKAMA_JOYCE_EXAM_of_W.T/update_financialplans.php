<?php
include('db_connection.php');

// Check if Plan ID is set
if (isset($_REQUEST['plan_id'])) {
  $plan_id = $_REQUEST['plan_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM financialplans WHERE PlanID=?");
  $stmt->bind_param("i", $plan_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $planID = $row['PlanID'];
    $plannerID = $row['PlannerID'];
    $clientID = $row['ClientID'];
    $title = $row['Title'];
    $description = $row['Description'];
  } else {
    echo "Financial plan not found.";
    exit; // Exit script if financial plan not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Financial Plan Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update financial plan information form -->
        <h2><u>Update Financial Plan Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="plannerID">Planner ID:</label>
            <input type="number" name="plannerID" value="<?php echo isset($plannerID) ? $plannerID : ''; ?>">
            <br><br>

            <label for="clientID">Client ID:</label>
            <input type="number" name="clientID" value="<?php echo isset($clientID) ? $clientID : ''; ?>">
            <br><br>

            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $plannerID = $_POST['plannerID'];
  $clientID = $_POST['clientID'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Update the financial plan in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE financialplans SET PlannerID=?, ClientID=?, Title=?, Description=? WHERE PlanID=?");
  $stmt->bind_param("iissi", $plannerID, $clientID, $title, $description, $plan_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: financialplans.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
