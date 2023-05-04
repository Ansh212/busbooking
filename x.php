<?php
// Set the time zone to match your server's time zone
date_default_timezone_set('UTC');

// Connect to the MySQL database
$servername = "localhost";
$username = "ansh";
$password = "Ansh@4321#@#";
$dbname = "busbooking2";

// Loop indefinitely
while (true) {

  // Connect to the database
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Calculate the date 1 week ago
  $one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));

// Delete old records from the student_ticket table
$sql = "DELETE FROM student_ticket WHERE date < '$one_week_ago'";
if ($conn->query($sql) === TRUE) {
    echo "Old records deleted successfully.";
} else {
    echo "Error deleting old records: " . $conn->error;
}


  // Close the database connection
  mysqli_close($conn);

  // Wait for 1 week before running the script again
  sleep(60); // 604800 seconds = 1 week
}
?>
