<!DOCTYPE html>
<<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management and Award System</title>
	<link rel="stylesheet" href="complain.css">
</head>
<body>
    <h1>Welcome to the Complaint Management and Award System</h1>

    <?php
 
    $server = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "complaints";

    $conn = new mysqli($server, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $institution = $_POST["institution"];
        $anonymous = isset($_POST["anonymous"]) ? 1 : 0;
        $department = $_POST["department"];
        $score = $_POST["score"];
        $complaint = $_POST["complaint"];


        $sql = "INSERT INTO complaints (institution, anonymous, department, score, complaint) 
                VALUES ('$institution', '$anonymous', '$department', '$score', '$complaint')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Complaint submitted successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="institution">Choose an Institution:</label>
        <select id="institution" name="institution" required>
            <option value="institution1">civil service</option>
            <option value="institution2">ethiotelecom</option>
            
        </select><br><br>

        <label for="anonymous">Anonymous:
        <input type="checkbox" id="anonymous" name="anonymous"></label>

        <label for="department">Choose a Department:</label>
        <select id="department" name="department" required>
            <option value="department1">software</option>
            <option value="department2">management</option>
            <option value="department3">customer service</option>
        </select><br><br>

        <label for="score">Rating:</label>
        <span id="rating-stars"></span>
        <input type="number" id="score" name="score" min="1" max="10" oninput="displayStars()"><br><br>

        <label for="complaint">Complaint:</label><br>
        <textarea id="complaint" name="complaint" rows="4" cols="50"></textarea><br><br>
<a href="showrate.PHP"><input type="submit" >Submit Complaint</a>
        
    </form>

    <hr>

    <h2>Independent Body - Award Preparation</h2>
	 <p><a href="award.PHP"> <h2>Independent Body - Award Preparation</h2></a></p>
   

    <script>
        function displayStars() {
            var rating = document.getElementById('score').value;
            var stars = '';

            for (var i = 1; i <= rating; i++) {
                stars += '* ';
            }

            document.getElementById('rating-stars').textContent = stars;
        }
    </script>

</body>
</html>