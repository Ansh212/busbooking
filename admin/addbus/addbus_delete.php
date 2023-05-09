<?php
session_start();
include('../../authentication/connection.php');
$temp=$_POST['bus_id'];

$sql2="SELECT * FROM drives WHERE bus_id ='$temp'";
$query2=mysqli_query($conn,$sql2);
$num2=mysqli_num_rows($query2);

if($num2>0){
    echo 'bus_id';
    exit();
}

$sql="DELETE FROM bus WHERE bus_id='$temp'";
if ($conn->query($sql) === TRUE) {
    echo "<p>Deleting successful!</p>";
    header("location:addbus.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
