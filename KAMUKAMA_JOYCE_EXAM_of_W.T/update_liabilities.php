<?php
include('db_connection.php');

// Check if Liability ID is set
if (isset($_REQUEST['liability_id'])) {
  $liability_id = $_REQUEST['liability_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM liabilities WHERE LiabilityID=?");
  $stmt->bind_param("i", $liability_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $liabilityID = $row['LiabilityID'];
    $userID = $row['UserID'];
    $liabilityName = $row['LiabilityName'];
    $amount = $row['Amount'];
  } else {
    echo "Liability not found.";
    exit; // Exit script if liability not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Liability Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update liability information form -->
        <h2><u>Update Liability Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="userID">User ID:</label>
            <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
            <br><br>

            <label for="liabilityName">Liability Name:</label>
            <input type="text" name="liabilityName" value="<?php echo isset($liabilityName) ? $liabilityName : ''; ?>">
            <br><br>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
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
  $liabilityName = $_POST['liabilityName'];
  $amount = $_POST['amount'];

  // Update the liability in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE liabilities SET UserID=?, LiabilityName=?, Amount=? WHERE LiabilityID=?");
  $stmt->bind_param("isdi", $userID, $liabilityName, $amount, $liability_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: liabilities.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
