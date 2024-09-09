<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userid = $_POST['userid'];
    $phone = $_POST['phone'];

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

    // Create the users table if it doesn't exist
    $createTableSql = "CREATE TABLE IF NOT EXISTS creat_account_user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        userid VARCHAR(50) NOT NULL,
        phone VARCHAR(15)
    )";
    if ($conn->query($createTableSql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }

    // Check if the username already exists
    $checkUsernameSql = "SELECT * FROM creat_account_user WHERE username = '$username'";
    $result = $conn->query($checkUsernameSql);
    if ($result->num_rows > 0) {
        $error = "Username already exists";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $insertUserSql = "INSERT INTO creat_account_user (fullname, email, username, password, userid, phone)
            VALUES ('$fullname', '$email', '$username', '$hashedPassword', '$userid', '$phone')";
        if ($conn->query($insertUserSql) === TRUE) {
            // User account created successfully
            // You can redirect the user to a success page or the login page
            echo "User account created successfully! Thank you!";
            header('Location: loginform.php');
            exit();
        } else {
            die("Error creating user account: " . $conn->error);
        }
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
  <title>Create Account - Hotel Website</title>
  <link rel="stylesheet" href="Create Account.css"> 
</head>
<body style="background-color:#32517a;">
  <div class="create-account-container">
    <h2>Create Account</h2>
    <form action="#" method="post">
      <?php if (isset($error)) { ?>
        <div class="error-message"><?php echo $error; ?></div>
      <?php } ?>
      <div class="form-group">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="userid">User ID:</label>
        <input type="text" id="userid" name="userid" required>
      </div>
      <div class="form-group">
        <label for="avatar">Upload User ID Picture/File:</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">
      </div>
      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[+2519]{5}[0-9]{8}" placeholder="Format: +2519XXXXXXXX" >
      </div>
      <button type="submit">Create Account</button>
    </form>
  </div>
</body>
</html>