<?php
include('db_connection.php');

// Check if Notification ID is set
if (isset($_REQUEST['notification_id'])) {
  $notification_id = $_REQUEST['notification_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM notifications WHERE NotificationID=?");
  $stmt->bind_param("i", $notification_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $notificationID = $row['NotificationID'];
    $userID = $row['UserID'];
    $message = $row['Message'];
    $date = $row['Date'];
  } else {
    echo "Notification not found.";
    exit; // Exit script if notification not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Notification Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update notification information form -->
        <h2><u>Update Notification Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="userID">User ID:</label>
            <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
            <br><br>

            <label for="message">Message:</label>
            <input type="text" name="message" value="<?php echo isset($message) ? $message : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
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
  $message = $_POST['message'];
  $date = $_POST['date'];

  // Update the notification in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE notifications SET UserID=?, Message=?, Date=? WHERE NotificationID=?");
  $stmt->bind_param("issi", $userID, $message, $date, $notification_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: notifications.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
