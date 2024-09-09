<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="images/fevicon.jpg" type="image/gif" />
    <link rel="stylesheet" href="useraccount.css">
    <style>
        
    </style>
</head>
<body style="background-color:#32517a">
<h1 >User Accounts</h1>
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

        // View user accounts
        function viewUserAccounts() {
            global $mysqli;
            // Fetch user accounts from 'users' table
            $sql = "SELECT * FROM creat_account_user";
            $result = $mysqli->query($sql);
            if ($result && $result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>User ID</th><th>Username</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['username'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No user accounts found.";
            }
        }

        // Display user accounts
        viewUserAccounts();
    ?>

    <?php
        // Close the database connection
        $mysqli->close();
    ?>
</body>
</html>