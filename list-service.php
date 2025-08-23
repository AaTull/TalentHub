<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as a provider
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'provider') {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provider_id = $_SESSION['user_id']; // Get provider ID from session
    $name = $conn->real_escape_string($_POST['iname']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);

    // Debugging: Check if provider_id is set correctly
    error_log("Provider ID: $provider_id");

    // Insert into database
    $sql = "INSERT INTO services (provider_id, iname, title, description, category) 
            VALUES ('$provider_id', '$name', '$title', '$description', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Service listed successfully!'); window.location.href='list-services.php';</script>";
    } else {
        echo "Error inserting service: " . $conn->error;
    }
}
?>
