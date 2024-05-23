<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'clients' => "SELECT  ClientID FROM clients WHERE ClientID LIKE '%$searchTerm%'",
        'assets' => "SELECT AssetName FROM assets WHERE AssetName LIKE '%$searchTerm%'",
        'consultations' => "SELECT  ConsultationID FROM consultations WHERE  ConsultationID LIKE '%$searchTerm%'",
        'financialplans' => "SELECT  Title FROM financialplans WHERE Title LIKE '%$searchTerm%'",
        'goals' => "SELECT GoalID FROM goals WHERE GoalID LIKE '%$searchTerm%'",
        'liabilities' => "SELECT LiabilityName FROM liabilities WHERE LiabilityName LIKE '%$searchTerm%'",
        'notifications' => "SELECT NotificationID FROM notifications WHERE NotificationID LIKE '%$searchTerm%'",
        'payments' => "SELECT PaymentID FROM payments WHERE  PaymentID LIKE '%$searchTerm%'",
        'planners' => "SELECT PlannerID FROM planners WHERE PlannerID LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>



