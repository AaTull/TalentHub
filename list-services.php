<?php
session_start();
include 'db_connect.php';

// Check if user is logged in as provider
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'provider') {
    die("Unauthorized access.");
}

$provider_id = $_SESSION['user_id']; // Get logged-in provider's ID

// Fetch services listed by this provider
$sql = "SELECT * FROM services WHERE provider_id = '$provider_id'";
$result = $conn->query($sql);

// Debugging: Check query result
if (!$result) {
    die("Query failed: " . $conn->error);
}

echo "<h2>Your Listed Services</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['title']} - {$row['category']} - {$row['description']}</p>";
    }
} else {
    echo "<p>No services found.</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Your Talent - TalentHub</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <nav class="menu" tabindex="0">
        <header class="avatar">
            <img src="https://img.freepik.com/free-vector/young-man-with-glasses-avatar_1308-175763.jpg?ga=GA1.1.1357850621.1733994787&semt=ais_hybrid" />
            <h2><?php echo $_SESSION['user_name']; ?></h2>
        </header>
        <ul>
            <li class="icon-dashboard"><a href="provider_dashboard.php">Home</a></li>
            <li class="icon-customers"><a href="list-services.php">Your Services</a></li>
            <li class="icon-users"><a href="provider_booking.php">Bookings</a></li>
            <li class="icon-settings"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <header>
        <h1>List Your Talent</h1>
    </header>
    
    <main>
        <div class="form-container">
            <form action="list-service.php" method="post" class="talent-form">
                <label for="iname">Name:</label>
                <input type="text" id="iname" name="iname" required>

                <label for="title">Service Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 TalentHub. All Rights Reserved.</p>
    </footer>
</body>
</html>
