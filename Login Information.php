<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="images/fevicon.jpg" type="image/gif" />
    <link rel="stylesheet" href="logininformation.css">
    <style>
       
    </style>
</head>
<body style="background-color: #32517a;color:white">
    <h1 style="color:black">Login Information</h1>
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

        // View login page information
        function viewLoginInfo() {
            global $mysqli;
            // Fetch login data from 'login' table
            $sql = "SELECT * FROM loginusers";
            $result = $mysqli->query($sql);
            if ($result && $result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Username</th><th>Password</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['username'] . "</td><td>" . $row['password'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No login information found.";
            }
        }

        // Display login information
        viewLoginInfo();
    ?>

    <?php
        // Close the database connection
        $mysqli->close();
    ?>
</body>
</html>