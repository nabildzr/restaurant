<?php

// $host = 'localhost';
// $user = 'root';
// $password = '';

// $database = 'db_restaurant_v1.1';

// $conn = mysqli_connect($host, $user, $password, $database);

// if (!$conn) {
//     die("db not connected" . mysqli_connect_error());
// }


// Load database credentials from a secure location
require_once __DIR__ .  '/config.php';

// Create a connection using mysqli
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// // Use prepared statements for queries
// $stmt = $conn->prepare("SELECT * FROM some_table WHERE some_column = ?");
// $stmt->bind_param("s", $some_value);
// $stmt->execute();
// $result = $stmt->get_result();

// // Fetch data
// while ($row = $result->fetch_assoc()) {
//     // Process data
// }

// // Close statement and connection
// $stmt->close();
// $conn->close();

?>

<!--  -->