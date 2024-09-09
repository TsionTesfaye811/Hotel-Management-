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

$createTableQuery = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

// Create the table if it doesn't exist
$mysqli->query($createTableQuery);

// Function to check if admin user already exists
function adminUserExists() {
    global $mysqli;
    $result = $mysqli->query("SELECT COUNT(*) FROM admin_users");
    $row = $result->fetch_row();
    $count = $row[0];
    return $count > 0;
}

// Function to authenticate the user
function authenticateUser($username, $password) {
    global $mysqli;
    // Prepare the SQL statement
    $stmt = $mysqli->prepare("SELECT id FROM admin_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    // Execute the query
    $stmt->execute();
    // Store the result
    $stmt->store_result();
    // Check if a row is returned, indicating a successful login
    if ($stmt->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if admin user already exists
    if (!adminUserExists()) {
        // Create the admin user
        $stmt = $mysqli->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        echo "Admin user created successfully!";
    } else {
        // Authenticate the user
        if (authenticateUser($username, $password)) {
            echo "Login successful!";
            // Redirect to the admin panel or any other authorized page
            header("Location: admin2.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Adila Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="images/fevicon.jpg" type="image/gif" />
   
    <link rel="stylesheet" href="loginform.css">

</head>
<body style="background-color:#32517a">
    <h1>Admin Login</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" name="login" value="Login">
		<label>
          <input type="checkbox" required>
          I agree to the <a href="terms.html" target="_blank">Terms and Conditions</a>
        </label>
      </div>
      <div class="additional-options">
        <a href="change credentials.php">Change Credentials</a>
       
      </div>
    </form>
</body>
</html>

<?php
// Close the database connection
$mysqli->close();
?>