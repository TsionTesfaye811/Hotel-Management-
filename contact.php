<!DOCTYPE html> 
<html> 
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Contact Form</title>
  <link rel="stylesheet" href="contact.css">
  
</head> 
<body> 
<?php // Database configuration
 $server = "localhost";
 $username = "root"; 
 $database = "contat";
 $password = "";
// Create a connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS contact (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
First_Name VARCHAR(30) NOT NULL,
Last_Name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
message TEXT NOT NULL,
timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === true) {
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get user input from the form
$First_Name = $_POST['fname'];
$Last_Name = $_POST['lname'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert user input into the contacts table
$sql = "INSERT INTO contact (First_Name, Last_Name, email, message) VALUES ('$First_Name', '$Last_Name', '$email', '$message')";

if ($conn->query($sql) === true) {
echo "Thank you for your message!"; // Success message
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
} else {
echo "Error creating table: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>

<h2>Contact Us or Give Us Your Fedback</h2> 
<form method="POST" action="contact.php"> 
<label for="fname">First Name:</label><br> <input type="text" id="fname" name="fname" required>
<br><br> 
<label for="lname">Last Name:</label><br>
 <input type="text" id="lname" name="lname" required><br><br>
<label for="email">Email:</label><br>
<input type="email" id="email" name="email" required><br><br>

<label for="message">Message:</label><br>

<textarea id="message" name="message" required></textarea>
<br><br>
 <input type="submit" value="Submit">
 </form>
 </body> 
 </html>