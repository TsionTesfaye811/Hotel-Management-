<?php
$server = "localhost";
$dbUsername = "root";
$password = "";
$dbName = "contat";

// Create a connection
$mysqli = new mysqli($server, $dbUsername, $password, $dbName);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to authenticate the admin user
function authenticateUser($username, $password) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT * FROM admin_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows === 1;
}

// Check if the change credentials form is submitted
if (isset($_POST['change_credentials'])) {
    $currentUsername = $_POST['current_username'];
    $currentPassword = $_POST['current_password'];
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    // Check if the current username and password match the admin's current credentials
    if (authenticateUser($currentUsername, $currentPassword)) {
        // Update the admin's username and password with the new values
        $stmt = $mysqli->prepare("UPDATE admin_users SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $newUsername, $newPassword, $adminId);
        $stmt->execute();
        echo "Credentials updated successfully!";
    } else {
        echo "Invalid current username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Admin Credentials</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="loginform.css">
</head>
<body style="background-color:#32517a">
    <h1>Change Admin Credentials</h1>
    <form method="POST" action="change_credentials.php">
	  <?php if (isset($error)) { ?>
        <div class="error-message"><?php echo $error; ?></div>
      <?php } ?>
        <label for="current_username">Current Username:</label>
        <input type="text" id="current_username" name="current_username" required><br>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br>

        <label for="new_username">New Username:</label>
        <input type="text" id="new_username" name="new_username" required><br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>

        <input type="submit" name="change_credentials" value="Change Credentials"> <div class="terms-and-conditions">
        
    </form>
</body>
</html>