<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}
$user_id = $_SESSION['user_id'];


// Display Bookings for Seekers
echo "<h2>Your Bookings</h2>";
$sql = "SELECT b.id, s.title, b.booking_date, b.status FROM bookings b JOIN services s ON b.service_id = s.id WHERE b.user_id='$user_id'";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "<p>Service: {$row['title']} | Date: {$row['booking_date']} | Status: {$row['status']}</p>";
}
?>
