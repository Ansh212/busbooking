<?php
session_start();
include('../authentication/connection.php');

$role = $_SESSION['role'];
$bus_id = $_POST['bus_id'];
$ticket_id = uniqid();
$booked_seats = 1;
$route_id = $_POST['route_id'];
$user = $_SESSION['usernow'];
$current_date = date("Y-m-d"); 

// Begin a transaction
$conn->begin_transaction();

// Check if the user has already booked a ticket for the same date
if($role == 'student') {
    $check_sql = "SELECT * FROM student_ticket WHERE student_id='$user' AND date='$current_date'";
} else if($role == 'faculty') {
    $check_sql = "SELECT * FROM faculty_ticket WHERE faculty_id='$user' AND date='$current_date'";
}

$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // User already booked a ticket for the same date
    echo 'No';
} 
else {
    // Select the number of available seats and lock the row for update
    $sql1 = "SELECT seats FROM bus WHERE bus_id = $bus_id FOR UPDATE";
    $result = $conn->query($sql1);
    $row = $result->fetch_assoc();

    // Check if there are enough available seats
    if ($row['seats'] >= $booked_seats) {
      // Update the number of available seats
      $new_seats = $row['seats'] - $booked_seats;
      $sql2 = "UPDATE bus SET seats = $new_seats WHERE bus_id = $bus_id";
      $conn->query($sql2);

      // Insert the new ticket
      if($role=='student'){
        $sql3 = "INSERT INTO student_ticket (ticket_id,student_id,bus_id,route_id,date) VALUES ('$ticket_id','$user','$bus_id','$route_id','$current_date')";
      } 
      else if($role=='faculty'){
         $sql3 = "INSERT INTO faculty_ticket (ticket_id,faculty_id,bus_id,route_id,date) VALUES ('$ticket_id','$user','$bus_id','$route_id','$current_date')";
      }

      if ($conn->query($sql3) === TRUE) {
        $_SESSION['ticket_id'] = $ticket_id;
        echo 'success'; 
        
      } 
      else {
        echo 'failed';
      }
    }
    else {
      // Not enough available seats
      echo 'no_seats';
    }
}

// Commit the transaction
$conn->commit();
?>
