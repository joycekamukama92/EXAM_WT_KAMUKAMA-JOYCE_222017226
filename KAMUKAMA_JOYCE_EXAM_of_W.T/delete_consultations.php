<?php
include('db_connection.php');

// Check if ConsultationID is set
if(isset($_REQUEST['consultation_id'])) {
    $consultation_id = $_REQUEST['consultation_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM consultations WHERE ConsultationID=?");
    $stmt->bind_param("i", $consultation_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="consultation_id" value="<?php echo $consultation_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Consultation ID is not set.";
}

$connection->close();
?>
