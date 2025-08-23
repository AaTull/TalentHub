<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "talenthub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$sql = "SELECT id, iname, title, description, category FROM services";
$result = $conn->query($sql);

$services = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($services);

$conn->close();
?>
