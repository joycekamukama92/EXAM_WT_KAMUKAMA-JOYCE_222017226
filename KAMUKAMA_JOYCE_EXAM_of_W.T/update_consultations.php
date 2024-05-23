<?php
include('db_connection.php');

// Check if Consultation ID is set
if (isset($_REQUEST['consultation_id'])) {
  $consultation_id = $_REQUEST['consultation_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM consultations WHERE ConsultationID=?");
  $stmt->bind_param("i", $consultation_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $consultationID = $row['ConsultationID'];
    $plannerID = $row['PlannerID'];
    $clientID = $row['ClientID'];
    $date = $row['Date'];
    $purpose = $row['Purpose'];
  } else {
    echo "Consultation not found.";
    exit; // Exit script if consultation not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Consultation Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update consultation information form -->
        <h2><u>Update Consultation Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="plannerID">Planner ID:</label>
            <input type="number" name="plannerID" value="<?php echo isset($plannerID) ? $plannerID : ''; ?>">
            <br><br>

            <label for="clientID">Client ID:</label>
            <input type="number" name="clientID" value="<?php echo isset($clientID) ? $clientID : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <label for="purpose">Purpose:</label>
            <input type="text" name="purpose" value="<?php echo isset($purpose) ? $purpose : ''; ?>">
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
  $date = $_POST['date'];
  $purpose = $_POST['purpose'];

  // Update the consultation in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE consultations SET PlannerID=?, ClientID=?, Date=?, Purpose=? WHERE ConsultationID=?");
  $stmt->bind_param("iissi", $plannerID, $clientID, $date, $purpose, $consultation_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: consultations.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
