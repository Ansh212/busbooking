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
        <title>Admin</title>

        
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
                            <span class="title">Welcome, Mani Bhai</span>
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
                        <a href="../addbus/addbus.php">
                            <span class="icon">
                                <ion-icon name="bus"></ion-icon>
                            </span>
                            <span class="title">Edit Buses</span>
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
                      <h1>Route List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Route ID</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Departure From Source</th>
                                    <th>Departure From Destination</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT * FROM route";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["route_id"] . "</td>";
                                    echo "<td>" . $row["source"] . "</td>";
                                    echo "<td>" . $row["destination"] . "</td>";
                                    echo "<td>" . $row["departure_src"] . "</td>";
                                    echo "<td>" . $row["departure_dst"] . "</td>";
                                    echo "<td>
                                    <form action='addroute_delete.php' method='POST'>
                                    <input type='hidden' name='route_id' value='" . $row["route_id"] . "' id = 'route_id' >
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
                    <h1>Add a New Route</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Route ID</th>
                                    <th>Starting Point</th>
                                    <th>Destination</th>
                                    <th>Departure From Source</th>
                                    <th>Departure From Destination</th>
                                    <th>Insert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <form action="addroute_add.php"  method="POST">
                                    <td>
                                        <input type="number" id="route_id" name="route_id" placeholder="Enter Route ID" />
                                    </td>
                                    <td>
                                        <input type="text" id="source" name="source" placeholder="Enter Starting Point"/>
                                    </td>
                                    <td>
                                        <input type="text" id="destination" name="destination" placeholder="Enter Destination Point"/>
                                    </td>
                                    <td>
                                        <input type="time" id="departure_src" name="departure_src" placeholder="Enter Departure Time From Source"/>
                                    </td>
                                    <td>
                                        <input type="time"  id="departure_dst" name="departure_dst" placeholder="Enter Departure Time From Destination"/>
                                    </td>

                                    <td> 
                                         <button type='submit'>ADD</button>
                                    </td>
                                </from>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
   </body>
</html>
