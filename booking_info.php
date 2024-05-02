<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
 
// Checking for connections
if ($conn->connect_error) {
    die('Connect Error (' .
    $conn->connect_errno . ') '.
    $conn->connect_error);
}
$email=$_SESSION['username'];
// SQL query to select data from database
$sql = "SELECT * FROM booking WHERE email='$email' ORDER BY 'date'";
$result = $conn->query($sql);
$conn->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>MY Booking Detalis</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
            border-collapse:collapse;
            margin-bottom:15px;
        }
 
        h1 {
            text-align: center;
            color: #17113f;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: lightblue;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
        .last {
            height:60px;
            width: 100%;
            background-color: #17113f;
            color: white;
            text-align: center;
            padding-top: 15px;
            bottom:0;
            left: 0;
            right: 0;
    }
    </style>
</head>
 
<body>
    <section>
        <h1>MY BOOKING DETAILS</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Item ID</th>
                <th>Booking date</th>
                <th>PI</th>
                <th>Place of Visit</th>

            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['item_id'];?></td>
                <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['pi'];?></td>
                <td><?php echo $rows['place'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    <footer class="last">
        <p>All rights are reserved | Design by- Panika & Radhika</p>
    </footer>
</body>
 
</html>