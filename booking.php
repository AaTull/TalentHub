<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_service'])) {
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in!");
    }

    $user_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];

    // Fetch provider_id from services table
    $query = "SELECT provider_id FROM services WHERE id = '$service_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $provider_id = $row['provider_id'];

        $booking_date = $_POST['booking_date'];
        $note = $conn->real_escape_string($_POST['note']);

        // Insert booking into database
        $sql = "INSERT INTO bookings (user_id, service_id, provider_id, booking_date, note, status) 
                VALUES ('$user_id', '$service_id', '$provider_id', '$booking_date', '$note', 'pending')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking request submitted successfully!'); window.location.href='seeker_dashboard.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        die("Service not found!");
    }
}
?>

<form method="POST" action="booking.php">
    <input type="hidden" name="service_id" value="<?php echo $_GET['service_id']; ?>">
    <input type="date" name="booking_date" required>
    <textarea name="note" placeholder="Notes"></textarea>
    <button type="submit" name="book_service">Book Now</button>
</form>
