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

// Create bookings table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(50) NOT NULL,
    num_rooms INT NOT NULL,
    checkin_date DATE NOT NULL,
    num_days INT NOT NULL,
    special_requests TEXT,
    total_price DECIMAL(10, 2) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tr_referential VARCHAR(255) NOT NULL
)";
if (!$mysqli->query($createTableQuery)) {
    echo "Error creating table: " . $mysqli->error;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $roomType = $_POST["room_type"];
    $numRooms = $_POST["num_rooms"];
    $checkinDate = $_POST["checkin"];
    $numDays = $_POST["num_days"];
    $specialRequests = $_POST["special_requests"];
    $totalPrice = $_POST["total_price"];
    $name = $_POST["name"];
   
    $tr_referential = $_POST["tr_referential"];

    // Validate number of days
    if ($numDays > 30) {
        echo "<p>Error: Maximum number of days allowed is 30.</p>";
        exit();
    }

    // Validate number of rooms based on room type
    $maxRooms = [
        "kings" => 20,
        "twins" => 40,
        "luxury" => 20,
        "standard" => 60
    ];
    if ($numRooms > $maxRooms[$roomType]) {
        echo "<p>Error: Maximum number of rooms for $roomType is {$maxRooms[$roomType]}.</p>";
        exit();
    }

    // Save the booking details to the database
    $insertQuery = "INSERT INTO bookings (room_type, num_rooms, checkin_date, num_days, special_requests, total_price, name, email, tr_referential) VALUES ('$roomType', $numRooms, '$checkinDate', $numDays, '$specialRequests', $totalPrice, '$name', '$email', '$tr_referential')";
    if ($mysqli->query($insertQuery)) {
        // Redirect to Booking Details page
        header("Location: Booking Details.php");
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form - Hotel Website</title>
    <link rel="stylesheet" href="bookingform.css">
    
</head>


<body>
<div class="booking-form">
    <h2>Booking Details</h2>
    <form id="bookingForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="room-selection">
            <div class="form-group">
                <label for="room_type">Room Type:</label>
                <select name="room_type" id="room_type" onchange="calculateTotalPrice()">
                    <option value="kings">Kings Room</option>
                    <option value="twins">Twin Room</option>
                    <option value="luxury">Luxury Room</option>
                    <option value="standard">Standard Room</option>
                </select>
            </div>
            <div class="form-group">
                <label for="num_rooms">Number of Rooms:</label>
                <input type="number" name="num_rooms" id="num_rooms" min="1" min="1" max="60"  value="1" onchange="calculateTotalPrice()">
            </div>
        </div>
        <div id="room_selections"></div>
        <button type="button" onclick="addRoom()">Add Room</button>
        <div class="form-group">
            <label for="checkin">Check-in Date:</label>
            <input type="date" name="checkin" id="checkin" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <label for="num_days">Number of Days (Max 30):</label>
            <input type="number" name="num_days" id="num_days" min="1" max="30" value="1" onchange="calculateTotalPrice()" required>
        </div>
        <div class="form-group">
            <label for="special_requests">Special Requests:</label>
            <textarea name="special_requests" id="special_requests" rows="4" cols="50"></textarea>
        </div>
        <div class="form-group">
            <label for="total_price">Total Price:</label>
            <input type="text" name="total_price" id="total_price" readonly>
        </div>
		<h2>pay in cbe account-name:Adila Hotel </h2>
		<h3>pay in cbe account-number:100001234564</h3>
		<label id="client_label">Please Enter there Transaction Referential:
		 <input type="text" name="client_name" id="tr_referential" placeholder="Tr.Ref:TTxxxxdxrx3" required>
        </label>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        
        <button type="submit">Confirm Booking</button>
    </form>
</div>
<script>
        function calculateTotalPrice() {
            var roomType = document.getElementById("room_type").value;
            var numRooms = document.getElementById("num_rooms").value;
            var numDays = document.getElementById("num_days").value;

            // Calculate total price based on room type, number of rooms, and number of days
            var pricePerRoom;
            if (roomType === "kings") {
                pricePerRoom = 2000;
            } else if (roomType === "twins") {
                pricePerRoom = 1500;
            } else if (roomType === "luxury") {
                pricePerRoom = 2100;
            } else if (roomType === "standard") {
                pricePerRoom = 800;
            }

            var totalPrice = pricePerRoom * numRooms * numDays;
            document.getElementById("total_price").value = totalPrice;
        }

        function addRoom() {
            var roomSelections = document.getElementById("room_selections");
            var newRoomSelection = document.createElement("div");

            // Set the maximum number of rooms based on room type
            var maxRooms = {
                "kings": 20,
                "twins": 40,
                "luxury": 20,
                "standard": 60
            };
            var roomType = document.getElementById("room_type").value;
            var maxNumRooms = maxRooms[roomType];

            newRoomSelection.innerHTML = `
                <div class="room-selection">
                    <div class="form-group">
                        <label for="room_type">Room Type:</label>
                        <select name="room_type" onchange="calculateTotalPrice()">
                            <option value="kings">Kings Room</option>
                            <option value="twins">Twin Room</option>
                            <option value="luxury">Luxury Room</option>
                            <option value="standard">Standard Room</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_rooms">Number of Rooms:</label>
                        <input type="number" name="num_rooms" min="1" max="${maxNumRooms}" value="1" onchange="calculateTotalPrice()">
                    </div>
                </div>
            `;
            roomSelections.appendChild(newRoomSelection);
        }
    </script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Thank you for your request. We will process your booking and send you a confirmation email shortly.</p>";
}
?>
</body>
</html>