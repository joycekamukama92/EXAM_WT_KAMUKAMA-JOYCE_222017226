<?php
include('db_connection.php');

// Check if asset_id is set
if(isset($_REQUEST['asset_id'])) {
    $asset_id = $_REQUEST['asset_id'];
    
    $stmt = $connection->prepare("SELECT * FROM assets WHERE AssetID=?");
    $stmt->bind_param("i", $asset_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['UserID'];
        $asset_name = $row['AssetName'];
        $value = $row['Value'];
    } else {
        echo "Asset not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Assets Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update assets form -->
    <h2><u>Update Form for Assets</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
  
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="asset_name">Asset Name:</label>
        <input type="text" name="asset_name" value="<?php echo isset($asset_name) ? $asset_name : ''; ?>">
        <br><br>
        
        <label for="value">Value:</label>
        <input type="number" name="value" value="<?php echo isset($value) ? $value : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
  
    $user_id = $_POST['user_id'];
    $asset_name = $_POST['asset_name'];
    $value = $_POST['value'];
    
    // Update the asset in the database
    $stmt = $connection->prepare("UPDATE assets SET UserID=?, AssetName=?, Value=? WHERE AssetID=?");
    $stmt->bind_param("issi", $user_id, $asset_name, $value, $asset_id);
    $stmt->execute();
    
    // Redirect to assets.php
    header('Location: assets.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
