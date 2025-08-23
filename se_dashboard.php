<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to login if the seeker is not logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'seeker') {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "talenthub";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Display Available Services
echo "<h2>Available Services</h2>";
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "<p><strong>Title:</strong> {$row['title']}<br>
          <strong>Description:</strong> {$row['description']}<br>
          <strong>Category:</strong> {$row['category']}<br> - <a href='booking.php?service_id={$row['id']}'>Book Now</a></p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://icongr.am/entypo/{icon}.svg?size={number}&color={hex}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="dashboard.css">
    <title>Responsive Sidebar Menu</title>
 
</head>
<body>

<nav class="menu" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <header class="avatar">
        <img src="https://img.freepik.com/free-vector/young-man-with-glasses-avatar_1308-175763.jpg?ga=GA1.1.1357850621.1733994787&semt=ais_hybrid" />
        <h2><?php echo $_SESSION['user_name']; ?></h2>
    </header>
    <ul>
        <li class="icon-dashboard"><a href="se_dashoboard.php"><span>Home</span></li>
        <li class="icon-customers   "><span>Search</span></li>
        <li class="icon-users"><a href="seeker_booking.php"><span>Bookings</span></li>
        <li class="icon-settings"><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<main>
    
          
</main>


</body>
</html>
