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

// Get booking ID from request
$bookingId = $_GET["id"];

// Update booking status to cancelled
$updateQuery = "UPDATE bookings SET status = 'cancelled' WHERE id = $bookingId";
if ($mysqli->query($updateQuery)) {
    echo "Booking cancelled successfully.";
} else {
    echo "Error cancelling booking: " . $mysqli->error;
}

// Close database connection
$mysqli->close();
?>