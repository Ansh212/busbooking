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
                        <a href="../addbus/addbus.php">
                            <span class="icon">
                                <ion-icon name="bus"></ion-icon>
                            </span>
                            <span class="title">Add Bus</span>
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
                        <a href="../addroute/addroute.php">
                            <span class="icon">
                                <ion-icon name="location"></ion-icon>
                            </span>
                            <span class="title">Insert Route</span>
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
                      <h1>Driver List</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Driver ID</th>
                                    
                                    <th>Phone</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM driver ";
                            $result = $conn->query($sql);
                            if ($result!=false && $result->num_rows > 0) {
                            // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["driver_id"] . "</td>";
                                    echo "<td>" . $row["phone"] . "</td>";
                                    echo "<td>
                                    <form action='adddriver_delete.php' method='POST'>
                                    <input type='hidden' name='driver_id' value='" . $row["driver_id"] . "' id = 'driver_id' >
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
                    <h1>Add a New Driver</h1><br><br> 
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Driver ID</th>
                                    <th>Driver Name</th>
                                    <th>Phone</th>
                                    <th>Insert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <form action="adddriver_add.php"  method="POST">
                                    <td>
                                        <input type="number" id="driver_id" name="driver_id" placeholder="Enter Driver ID" />
                                    </td>
                                    <td>
                                        <input type="text" id="name" name="name" placeholder="Enter Driver Name"/>
                                    </td>
                                    <td>
                                        <input type="number" id="phone" name="phone" placeholder="Enter Phone number"/>
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
