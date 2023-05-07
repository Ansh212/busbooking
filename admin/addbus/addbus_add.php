
<?php
session_start();
require('../../authentication/connection.php');

$bid = $_POST['bus_id'];
$brole = $_POST['role'];
$rid = $_POST['route_id'];
$seats = $_POST['seats'];
$did = $_POST['driver_id'];
$status = "true";

$sql1="SELECT * FROM bus WHERE bus_id ='$bid'";
$query1=mysqli_query($conn,$sql1);
$num1=mysqli_num_rows($query1);
if($num1 > 0){
    echo 'bus_id';
    exit();
}

$sql2="SELECT * FROM bus WHERE driver_id ='$did'";
$query2=mysqli_query($conn,$sql2);
$num2=mysqli_num_rows($query2);

$sql4="SELECT * FROM driver WHERE driver_id ='$did'";
$query4=mysqli_query($conn,$sql4);
$num4=mysqli_num_rows($query4);

if($num2 >0 OR $num4 == 0){
    echo 'driver_id';
    exit();
}
$sql3="SELECT * FROM route WHERE route_id ='$rid'";
$query3=mysqli_query($conn,$sql3);
$num3=mysqli_num_rows($query3);
if($num3 == 0){
    echo 'route_id';
    exit();
}

$sql = "INSERT INTO bus (`bus_id`,`driver_id`,`route_id`,`seats`,`role`,`status`)
        VALUES ('$bid','$did','$rid','$seats','$brole','$status')";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo 'success';
} 
else {
    echo 'error';
}
?>





