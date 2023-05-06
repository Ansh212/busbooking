<?php
session_start();
if(!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn']){
   header("location:index.php");
}
?>
<?php
include('../../authentication/connection.php');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Delete</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="../assets/css/style.css">

       <!-- =========== Scripts =========  -->
        
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>

    <body>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="person-circle"></ion-icon>
                            </span>
                            <span class="title">Welcome, Ansh Bhai</span>
                        </a>
                    </li>

                    <li>
                        <a href="../adminindex.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../adddriver/adddriver.php">
                            <span class="icon">
                                <ion-icon name="person"></ion-icon>
                            </span>
                            <span class="title">Edit Drivers</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="../addroute/addroute.php">
                            <span class="icon">
                                <ion-icon name="location"></ion-icon>
                            </span>
                            <span class="title">Edit Routes</span>
                        </a>
                    </li>                   
                    <li>
                        <a href="../addstudent/addstudent.php">
                            <span class="icon">
                                <ion-icon name="school"></ion-icon>
                            </span>
                            <span class="title">Edit Students</span>
                        </a>
                    </li>  
                    <li>
                        <a href="../addfaculty/addfaculty.php">
                            <span class="icon">
                                <ion-icon name="book"></ion-icon>
                            </span>
                            <span class="title">Edit Faculty</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../logout/logout.php">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ========================= Main ==================== -->
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>    
                </div>

                <div class="details">
                      <h1>Bus Schedule</h1><br><br>
                        <div class="form-row">
                            <form action='addbus_enableall.php' method='POST'>
                              <button type='submit'>ENABLE ALL</button> 
                            </form>
                            <form action='addbus_disableall.php' method='POST'>
                                <button type='submit'>DISABLE ALL</button> 
                            </form>
                            <div style="clear:both;"></div> 
                        </div>
                        <br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Bus Role</th>
                                    <th>Departure From Source</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Departure From Destination</th>
                                    <th>Seats</th>
                                    <th>Delete</th>
                                    <th>Disable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT bus.bus_id,bus.role, route.departure_src,route.source, route.destination,route.departure_dst,bus.seats,bus.driver_id,bus.status FROM bus INNER JOIN route ON bus.route_id = route.route_id ";
                                    $result = $conn->query($sql);
                                    if ($result!=false && $result->num_rows > 0) {
                                    // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["bus_id"] . "</td>";
                                            echo "<td>" . $row["role"] . "</td>";
                                            echo "<td>" . $row["departure_src"] . "</td>";
                                            echo "<td>" . $row["source"] . "</td>";
                                            echo "<td>" . $row["destination"] . "</td>";
                                            echo "<td>" . $row["departure_dst"] . "</td>";
                                            echo "<td>" . $row["seats"] . "</td>";
                                            echo "<td>
                                            <form action='addbus_delete.php' method='POST'>
                                            <input type='hidden' name='bus_id' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                            <button type='submit'>DELETE</button> 
                                            </form>                                    
                                            </td>";
                                            if ($row["status"]=='true') {
                                                echo "<td>
                                                <form action='addbus_disable.php' method='POST'>
                                                <input type='hidden' name='busid' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                                <button type='submit'>DISABLE</button> 
                                                </form>                                    
                                                </td>";
                                                echo "</tr>";
                                            }
                                            else { 
                                                echo "<td>
                                                <form action='addbus_enable.php' method='POST'>
                                                <input type='hidden' name='busid' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                                <button type='submit'>ENABLE</button> 
                                                </form>                                    
                                                </td>";
                                                echo "</tr>";
                                            }
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                ?>
                            </tbody>
                        </table><br>
                        <h1>Add a New Bus</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Bus ID</th>
                                    <th>Bus Role</th> 
                                    <th>Route ID</th>
                                    <th>Seats</th>
                                    <th>Driver ID</th>
                                    <th>Insert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" id="bid" name="bid" placeholder="Enter BUS ID" />
                                    </td>
                                    <td>
                                        <input type="text" id="rol" name="rol" placeholder="Enter BUS Role" />
                                    </td>
                                    <td>
                                        <input type="number" id="rid" name="rid" placeholder="Enter Route ID"/>
                                    </td>
                                    <td>
                                        <input type="number" id="seat" name="seat" placeholder="Enter Total Seats"/>
                                    </td>
                                    <td>
                                        <input type="number" id="did" name="did" placeholder="Enter Driver ID"/>
                                    </td> 
                                    <td>
                                        <input type='submit' value='ADD' class='btton' onclick='validateForm()' /> 
                                    </td>
                                </tr>
                            </tbody>
                        </table><br>
                <p style="color:red" id="test" ></p>
                </div>
            </div>
        </div>
<script>
    function validateForm() {
        let bus_id = document.getElementById('bid').value;
        let role = document.getElementById('rol').value; 
        let route_id = document.getElementById('rid').value;
        let seats = document.getElementById('seat').value;
        let driver_id = document.getElementById('did').value;
        sendData(bus_id,role,route_id,seats,driver_id);
        return true;
    }  

    function sendData(bus_id,role,route_id,seats,driver_id) {
        $.ajax({
            type: "POST",
            url: "addbus_add.php",
            data: { 
                bus_id:bus_id,
                role:role,
                route_id:route_id,
                seats:seats,
                driver_id:driver_id
            },
            success: function(response) {
                response=response.trim();
                console.log(response);
                if(response === 'bus_id'){
                    $('#test').html('This Bus is already in use please give another ID'); 
                }
                else if(response === 'driver_id'){
                    $('#test').html('Driver is already assinged to different bus please provide another driver or there is no driver with this ID'); 
                }
                else if(response === 'route_id'){
                    $('#test').html('There is no route with this ID, please assign different ID to route'); 
                }
                else if(response=='success'){
                    window.location.href = 'addbus.php';
                }
                else{
                    $('#test').html('Error from server side,please try after some time');
                }
            }
        });
    }
</script>
<script src="../assets/js/main.js"></script>

   </body>
</html>
