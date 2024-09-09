<?php
$server = "localhost";
$dbUsername = "root";
$dbName = "contat";
$dbPassword = "";

// Create a connection
$conn = new mysqli($server, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the forget_password table
$sql = "CREATE TABLE forget_password (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Table 'forget_password' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Website Login</title>
  <link rel="stylesheet" href="loginform.css"> 
</head>
<style>
h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}
</style>
<body>
  <div class="login-container">
    <h2>Hotel Website Login</h2>
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the form is submitted
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Perform username and password verification logic
        if ($username === "example" && $password === "password123") {
          // Username and password match, update the password and redirect to login page
          $newPassword = $_POST['new-password'];

          // Save the new password to the database

          // Redirect to the login page
          header("Location: bookingform.html");
          exit();
        } else {
          // Username and password do not match
          echo "<p class='error-message'>Invalid username or password. Please try again.</p>";
        }
      }
    ?>
    <form action="#" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" name="new-password" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
      </div>
      <button type="submit">Login</button>
      <div class="terms-and-conditions">
        <label>
          <input type="checkbox" required>
          I agree to the <a href="terms.html" target="_blank">Terms and Conditions</a>
        </label>
      </div>
      <div class="additional-options">
        <a href="forgot_password.html">Forget Password</a>
        <a href="create_account.html">Create Account</a>
      </div>
    </form>
  </div>
</body>
</html>