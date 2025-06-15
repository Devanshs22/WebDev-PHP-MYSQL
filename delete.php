<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the logged-in user
$user_id = $_SESSION['user_id'];

// Delete the user's own account
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Destroy session after deletion
    session_destroy();
    header("Location: login.html");
    exit();
} else {
    echo "Error deleting account.";
}

$stmt->close();
$conn->close();
?>
