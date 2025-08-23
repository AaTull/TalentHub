<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "talenthub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }
    $password = $_POST['password'];
    $user_type = $_POST['user_type']; // 'seeker' or 'provider'

    // Prepare SQL query using prepared statements to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ? AND user_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $user_type); // 'ss' means two string parameters (email, user_type)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_type'] = $user_type;

            // Redirect to the appropriate dashboard
            if ($user_type == 'seeker') {
                header("Location: se_dashboard.php");
            } else {
                header("Location: pro_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "Invalid email or password. Please try again.";
    }
}

$conn->close();
?>
