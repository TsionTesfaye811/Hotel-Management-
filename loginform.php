<?php
$usernameError = '';
$passwordError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database configuration
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

    // Perform the login authentication
    $sql = "SELECT * FROM creat_account_user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $storedPassword)) {
            // Authentication successful
            // Redirect the user to the bookingform.php page
            header('Location: bookingform.php');
            exit();
        } else {
            // Invalid password
            $passwordError = 'Invalid password';
        }
    } else {
        // Invalid username
        $usernameError = 'Invalid username';
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adila Hotel Website Login</title>
  <link rel="stylesheet" href="loginform.css"> 
</head>
<style>
h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}
</style>
<body style="background-color:#32517a;">
  <div class="login-container">
    <h2>Hotel Website Login</h2>
    <form action="#" method="post">
      <?php if (!empty($usernameError)) { ?>
        <div class="error-message"><?php echo $usernameError; ?></div>
      <?php } ?>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <?php if (!empty($passwordError)) { ?>
        <div class="error-message"><?php echo $passwordError; ?></div>
      <?php } ?>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
      <div class="terms-and-conditions">
        <label>
          <input type="checkbox" required>
          I agree to the <a href="terms.html" target="_blank">Terms and Conditions</a>
        </label>
      </div>
      <div class="additional-options">
        <a href="forgot.php">Forget Password</a>
        <a href="create_account.php">Create Account</a>
      </div>
    </form>
  </div>
</body>
</html>