<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "hotel_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Rooms - Hotel Website</title>
  <link rel="stylesheet" href="rooms.css">
</head>
<body>
  <div class="container">
    <?php
    // SQL query to select data from the database
    $sql = "SELECT * FROM rooms";
    $result = $conn->query($sql);

    // Display data from the database
    if ($result->num_rows > 0) {
      // Output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<div class='room " . $row["type"] . "' data-available='" . $row["availability"] . "'>";
        echo "<img src='" . $row["image"] . "' alt='" . $row["type"] . " Room'>";
        echo "<div class='room-details'>";
        echo "<h3>" . $row["type"] . "</h3>";
        echo "<p class='description'>" . $row["description"] . "</p>";
        echo "<p class='price'>" . $row["price"] . " ETB per night</p>";
        echo "<a href='loginform.html' class='book-button'>Book Now</a>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "0 results";
    }
    ?>
  </div>

  <script src="script.js">
  
  document.addEventListener('DOMContentLoaded', function() {
  const bookButtons = document.querySelectorAll('.book-button');

  bookButtons.forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault();

      const room = this.closest('.room');
      const availableRooms = room.dataset.available;

      if (availableRooms > 0) {
        const roomType = room.querySelector('h3').textContent;
        const confirmBooking = confirm(`You are booking a ${roomType}. ${availableRooms} rooms available. Proceed to login?`);

        if (confirmBooking) {
          window.location.href = 'login.html';
        }
      } else {
        alert('Sorry, this room is currently not available. Please choose another room.');
      }
    });
  });
});
  </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>