<?php
include 'db_connect.php';
session_start();

// Check if user is logged in as a provider
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'provider') {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<nav class="menu">
    <header class="avatar">
        <img src="https://img.freepik.com/free-vector/young-man-with-glasses-avatar_1308-175763.jpg" />
        <h2><?php echo $_SESSION['user_name']; ?></h2>
    </header>
    <ul>
        <li><a href="list-services.php">List Services</a></li>
        <li><a href="provider_booking.php">Bookings</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<main>
    <h2>Manage Your Bookings</h2>
</main>

</body>
</html>
