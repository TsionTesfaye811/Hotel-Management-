<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="images/fevicon.jpg" type="image/gif" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="Contact Messages.css">
</head>
<body style="background-color:#32517a;color:white">
    <h1 style="color:black">Contact Messages</h1>
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

    // View contact us messages
    function viewContactMessages() {
        global $mysqli;
        // Fetch contact messages from 'contact' table
        $sql = "SELECT * FROM contact";
        $result = $mysqli->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                echo '<table border="1">
                        <tr>
                            <th>From</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['message'] . '</td>
                          </tr>';
                }
                echo '</table>';
            } else {
                echo "No messages found.";
            }
        } else {
            echo "Error fetching contact messages: " . $mysqli->error;
        }
    }

    // Display contact messages
    viewContactMessages();

    // Close the database connection
    $mysqli->close();
    ?>
</body>
</html>