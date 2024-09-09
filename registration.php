<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Management and Award System - Registration</title>
  <link rel="stylesheet" href="complain.css">
</head>
<body>
  <h1>Registration Form</h1>

  <?php
 
  $server = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "complaints";

  $conn = new mysqli($server, $dbUsername, $dbPassword, $dbName);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

 
  $sql_create_table = "CREATE TABLE IF NOT EXISTS registrations (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(100) NOT NULL
  )";
  
  if ($conn->query($sql_create_table) === TRUE) {
      echo "<p>Table 'registrations' created successfully or already exists.</p>";
  } else {
      echo "Error creating table: " . $conn->error;
  }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $email = $_POST["email"];

    
      $sql = "INSERT INTO registrations (name, email) VALUES ('$name', '$email')";

      if ($conn->query($sql) === TRUE) {
          echo "<p>Registration successful.</p>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h2>User Registration</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <input type="submit" value="Register">
  </form>

  <p style="text-align:center">Already registered? <a href="customer_management.PHP" >Go to Customer Management</a></p>
</body>
</html>