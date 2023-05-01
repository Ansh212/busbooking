<?php
session_start();
if(!isset($_SESSION['loggedIn']) && !$_SESSION['loggedIn']){
   header("location:../index.php");
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

        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="../assets/css/style.css">

       <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

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
                                    <th>Driver_ID</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                         
                                $sql = "SELECT bus.bus_id,bus.role, route.departure_src,route.source, route.destination,route.departure_dst,bus.seats,bus.driver_id FROM bus INNER JOIN route ON bus.route_id = route.route_id ";
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
                                        echo "<td>" . $row["driver_id"] . "</td>";
                                        echo "<td>
                                        <form action='addbus_delete.php' method='POST'>
                                        <input type='hidden' name='bus_id' value='" . $row["bus_id"] . "' id = 'bus_id' >
                                        <button type='submit'>DELETE</button> 
                                        </form>                                    
                                        </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                            ?>
                        </tbody>
                    </table>
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
                                <form action="addbus_add.php"  method="POST">
                                    <td>
                                        <input type="number" id="bus_id" name="bus_id" placeholder="Enter BUS ID" />
                                    </td>
                                    <td>
                                        <input type="text" id="role" name="role" placeholder="Enter BUS Role" />
                                    </td>
                                    <td>
                                        <input type="number" id="route_id" name="route_id" placeholder="Enter Route ID"/>
                                    </td>
                                    <td>
                                        <input type="number" id="seats" name="seats" placeholder="Enter Total Seats"/>
                                    </td>
                                    <td>
                                        <input type="number" id="driver_id" name="driver_id" placeholder="Enter Driver ID"/>
                                    </td> 
                                    <td> 
                                        <button type="submit">ADD</button>                                       
                                    </td>
                                </form>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
   </body>
</html>
