<?php
session_start();

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    
    <style>
        /* body{ 
          font: 14px sans-serif;
          text-align: center; 
        } */
        #welcome{
          text-align:center;
          font:14px;
          background-color:lightblue;
          border:2px solid black;
          width:750px;
          padding:4px;
          margin-left:280px;
        }
        button{
            background-color: #17113f;
            padding: 15px;
            text-align: center;
            width: 225px;
            border:none;
            margin-top: 15px;
            color:white;
            display: block;
            margin-left: auto;
            margin-right: auto;
            /* width: 40%; */
        
        }
        
        
    </style>
</head>
<body>
<header >
        <div class="navbar">
            <div class="nav-logo border">
                <div class="logo"></div>
            </div>
            <div class="nav-home border">
                <p class="icons"><a href="index.php" class="link">HOME</a></p>
            </div>
            <div class="nav-items border">
                <p class="icons"><a href="#product1" class="link">EQUIPMENTS</a></p>
            </div>
            <div class="nav-contact border">
                <p class="icons">CONTACT US</p>
            </div>
            <div class="nav-user border" >
                <i class="fa-regular fa-user" style="margin-left:13px"></i><pre> </pre>
                <p class="sign"><a class="link1" href="logout.php">LOGOUT</a></p>
            </div>
            <div class="nav-login border" >
                <p class="icons"><a href="reset-password.php" class="link">RESET-PASS</a></p>
            </div>
        </div>
    </header>
    <h2 id="welcome" style="margin-top:65px">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h2>
    <div class="box" style="margin-left:400px">
    <p style="text-align:center;padding:25px"><b>CLICK HERE</b></p>
    <button type="submit" onclick="document.location='bookindex.php'">BOOK NOW</button>  <button type="submit" onclick="document.location='booking_info.php'">YOUR BOOKINGS</button>
    
        
    </div>
    <footer class="last">
        <p>All rights are reserved | Design by- Panika & Radhika</p>
    </footer>
</body>
</html>