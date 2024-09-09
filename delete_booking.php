<?php
// Establish database connection
$server = "localhost";
$dbUsername = "root";
$password = "";
$dbName = "contat";

$mysqli = new mysqli($server, $dbUsername, $password, $dbName);
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Get the booking ID from the URL
$bookingId = $_GET['id'];

// Validate the booking ID
if (!is_numeric($bookingId) || $bookingId <= 0) {
    die("Invalid booking ID.");
}

// Delete the booking record
$deleteQuery = "DELETE FROM bookings WHERE id = ?";
$stmt = $mysqli->prepare($deleteQuery);
$stmt->bind_param("i", $bookingId);

if ($stmt->execute()) {
    // Delete successful
    header("Location: booking Detail.php");
    exit;
} else {
    // Delete failed
    echo "Error deleting booking: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();