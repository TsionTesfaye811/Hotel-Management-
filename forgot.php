<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = "localhost";
    $dbUsername = "root";
    $dbName = "contat";
    $dbPassword = "";

    // Establish the database connection
    $conn = new mysqli($server, $dbUsername, $dbPassword, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the submitted username
    $username = $_POST['username'];

    // Check if the username exists in the database
    $sql = "SELECT * FROM creat_account_user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username found, display message to enter a new password
        echo "Enter your new password, please.";
        echo "<form id='updatePasswordForm' method='POST' action='loginform.php'>";
        echo "<input type='hidden' name='username' value='$username'>";
        echo "<input type='password' name='new_password' placeholder='Enter your new password'>";
        echo "<button type='submit'>Update Password</button>";
        echo "</form>";
    } else {
        // Username not found, display message to create an account
        echo "Please create an account first. You are the first user in our hotel.";
    }

    $conn->close();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
    $server = "localhost";
    $dbUsername = "root";
    $dbName = "contat";
    $dbPassword = "";

    // Establish the database connection
    $conn = new mysqli($server, $dbUsername, $dbPassword, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the submitted data
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];

    // Update the password in the database
    $sql = "UPDATE creat_account_user SET password = '$newPassword' WHERE username = '$username'";
    if ($conn->query($sql) === true) {
        if ($conn->affected_rows > 0) {
            echo "Your password has been successfully changed. ";
            echo "<a href='loginform.php'>Now please login</a>";
        } else {
            echo "No rows were affected. The password was not updated.";
        }
    } else {
        echo "Error updating password: " . $conn->error;
    }

    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
	 <link rel="stylesheet" href="forgot.css">
</head>
<body style="background-color:#32517a">
    <div id="message"></div>
    <form id="forgotPasswordForm" method="POST" action="loginform.php">
        <input type="text" name="username" placeholder="Enter your username">
        <button type="submit">Submit</button>
    </form>
    <script>
        var form = document.getElementById('forgotPasswordForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var username = document.querySelector('input[name="username"]').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'forgo.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById('message').innerHTML = xhr.responseText;
                    if (xhr.responseText.includes('Enter your new password, please.')) {
                        // Show a new form to enter a new password
                        document.getElementById('forgotPasswordForm').style.display = 'none';
                        document.getElementById('updatePasswordForm').style.display = 'block';
                    }
                }
            };
            xhr.send('username=' + encodeURIComponent(username));
        });
    </script>
</body>
</html>