<?php
session_start();
include('../../authentication/connection.php');
$temp=$_POST['student_id'];
$sql="DELETE FROM student WHERE student_id='$temp'";
if ($conn->query($sql) === TRUE) {
    echo "<p>Deleting successful!</p>";
    header("location:addstudent.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>