<?php
include('db_connection.php');

// Check if Payment ID is set
if (isset($_REQUEST['payment_id'])) {
  $payment_id = $_REQUEST['payment_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
  $stmt->bind_param("i", $payment_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $paymentID = $row['PaymentID'];
    $clientID = $row['ClientID'];
    $amount = $row['Amount'];
    $date = $row['Date'];
  } else {
    echo "Payment not found.";
    exit; // Exit script if payment not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Payment Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update payment information form -->
        <h2><u>Update Payment Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="clientID">Client ID:</label>
            <input type="number" name="clientID" value="<?php echo isset($clientID) ? $clientID : ''; ?>">
            <br><br>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $clientID = $_POST['clientID'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];

  // Update the payment in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE payments SET ClientID=?, Amount=?, Date=? WHERE PaymentID=?");
  $stmt->bind_param("idis", $clientID, $amount, $date, $payment_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: payments.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
