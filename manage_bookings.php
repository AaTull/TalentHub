<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'provider') {
    header("Location: login.php");
    exit();
}

$provider_id = $_SESSION['user_id'];

echo "<h2>Manage Your Bookings</h2>";
$sql = "SELECT b.id, u.name, s.title, b.booking_date, b.status FROM bookings b 
        JOIN services s ON b.service_id = s.id 
        JOIN users u ON b.user_id = u.id 
        WHERE b.provider_id = '$provider_id'";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['name']} booked {$row['title']} on {$row['booking_date']} - Status: {$row['status']} - ";
    echo "<a href='manage_bookings.php?action=accept&booking_id={$row['id']}'>Accept</a> | ";
    echo "<a href='manage_bookings.php?action=reject&booking_id={$row['id']}'>Reject</a></p>";
}

if (isset($_GET['action']) && isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
    $status = $_GET['action'] === 'accept' ? 'accepted' : 'rejected';

    $sql = "UPDATE bookings SET status='$status' WHERE id='$booking_id' AND provider_id = '$provider_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Booking status updated!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
