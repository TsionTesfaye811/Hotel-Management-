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
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "Username: " . $row['username'] . ", password: " . $row['password'] . "<br>";
        }
    } else {
        echo "Error fetching login information: " . $mysqli->error;
    }
}

// View contact us messages
function viewContactMessages() {
    global $mysqli;
    // Fetch contact messages from 'contact' table
    $sql = "SELECT * FROM contact";
    $result = $mysqli->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "From: " . $row['firstName'] . $row['lastName']. "  Email: " . $row['email'] . "  Message: " . $row['message'] ."<br>";
        }
    } else {
        echo "Error fetching contact messages: " . $mysqli->error;
    }
}

// View user accounts
function viewUserAccounts() {
    global $mysqli;
    // Fetch user accounts from 'users' table
    $sql = "SELECT *FROM creat_account_user";
    $result = $mysqli->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "User ID: " . $row['id'] . ", Username: " . $row['username'] . "<br>";
        }
    } else {
        echo "Error fetching user accounts: " . $mysqli->error;
    }
}

// View booking details
function viewBookings() {
    global $mysqli;
    // Fetch booking details from 'bookings' table
    $sql = "SELECT * FROM bookings";
    $result = $mysqli->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "Booking ID: " . $row['id'] . ", Room: " . $row['room_type'] . "number of rooms : " . $row['num_rooms'] . "check in date: " . $row['checkin_date']. "special_requests: ".$row['special_requests'] . "total_price: " . $row['total_price']."<br>";
        }
    } else {
        echo "Error fetching booking details: " . $mysqli->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
	 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="images/fevicon.jpg" type="image/gif" />
    <link rel="stylesheet" href="admin.css">
	 <link rel="stylesheet" href="css/style.css">
	
</head>
<body style="background-color:#32517a">
<header class="header"style="background-color:#32517a">
        <span class="logo">
            <a href="adila.html"><image src="images/logo.png" alt="#logo here" ></a>
        </span>
     
        <nav style="color:white">
            <ul class="menu" style="color:white">
                <li><a  style="color:white;" href="Login Information.php">Login Information</a></li>
                <li><a  style="color:white;" href="Contact Messages.php">Feedback</a></li>
                <li><a style="color:white;" href="User Accounts.php">User Accounts</a></li>
                <li><a style="color:white;"href=" Booking Detail.php">Booking Details</a></li>
                
            </ul>
        </nav>
    </header>
    <div>
     
      <h1  style="background-color:dodgerblue;color:white";class="slide-heading">Welcome to Adila Hotel Admin page</h1>
			
       <a href="admin2.php" target="_self">
            <img src="images/adilafront.png" alt="adila staff photo" width="100%" height="300px">
          </a>
		  </div>
        
<footer>
<div class="copyright">
            <p>Copyright © 2016 Adila Hotel Website. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>


</body>
</html>
 <?php
// Close the database connection
$mysqli->close();
?>