<?php

session_start(); // Start a session to store user login status

// Database credentials
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// User Management
function createUser($username, $password) {
    global $mysqli;
    // Code to create a new user account using $mysqli connection
    // Example: $mysqli->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
}

function modifyUser($userId, $newUsername, $newPassword) {
    global $mysqli;
    // Code to modify user information using $mysqli connection
}

function deleteUser($userId) {
    global $mysqli;
    // Code to delete a user account using $mysqli connection
}

// Hotel Management





// Booking Management
function viewBooking($bookingId) {
    global $mysqli;
    // Code to retrieve and display booking details using $mysqli connection
}

function modifyBooking($bookingId, $newDetails) {
    global $mysqli;
    // Code to modify a booking using $mysqli connection
}


// Contact Us
function handleContactForm($name, $email, $message) {
    global $mysqli;
    // Code to handle the contact form submission using $mysqli connection
    $sql = "INSERT INTO contact (FullName, email, message) VALUES ('$name', '$email', '$message')";
    if ($mysqli->query($sql) === true) {
        echo "Thank you for your message!"; // Success message
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Create Account
function handleCreateAccountForm($fullname, $email, $username, $password, $userid, $phone) {
    global $mysqli;

    // Check if the user has administrative privileges
    // For demonstration purposes, let's assume the administrator's username is "admin"
    $adminUsername = "admin";
    $isAdmin = false;

    // Fetch the user details based on the username
    $getUserSql = "SELECT * FROM users WHERE username = '$adminUsername'";
    $result = $mysqli->query($getUserSql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if the user has administrative privileges
        // Adjust the condition based on your specific logic
        if ($user['role'] === 'admin') {
            $isAdmin = true;
        }
    }

    if (!$isAdmin) {
        echo "You do not have permission to create user accounts.";
        return;
    }

    // Check if the username already exists
    $checkUsernameSql = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($checkUsernameSql);

    if ($result->num_rows > 0) {
        echo "Username already exists";
        return;
    }

    // Insert the new user into the database
    $insertUserSql = "INSERT INTO users (fullname, email, username, password, userid, phone) VALUES ('$fullname', '$email', '$username', '$password', '$userid', '$phone')";

    if ($mysqli->query($insertUserSql) === TRUE) {
        echo "User account created successfully";
    } else {
        echo "Error creating user account: " . $mysqli->error;
    }
}

// Login
function handleLoginForm($username, $password) {
    global $mysqli;

    // Check if the username and password match the database records
    $loginSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($loginSql);

    if ($result->num_rows === 1) {
        // Username and password are correct, set the user as logged in
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        echo "Login successful!";
    } else {
        echo "Invalid username or password";
    }
}

// Forgot Password
function handleForgotPasswordForm($username) {
    global $mysqli;

    // Check if the username exists in the database
    $checkUsernameSql = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($checkUsernameSql);

    if ($result->num_rows === 1) {
        // Username exists, prompt the user to enter a new password
        echo "Please enter your new password:<br>";
        echo "<form method='post' action='reset_password.php'>";
        echo "<input type='hidden' name='username' value='$username'>";
        echo "<input type='password' name='new_password'>";
        echo "<input type='submit' value='Reset Password'>";
        echo "</form>";
    } else {
        echo "Invalid username";
    }
}

// Logout
function handleLogout() {
    // Destroy the session and redirect the user to the login page
    session_destroy();
    header("Location: login.php");
    exit;
}

?>