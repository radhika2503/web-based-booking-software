
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body{
            overflow-x: hidden;
            
        }
        input:focus{
            background-color: rgb(221, 246, 255);
        }
        input:blur{
            background-color: red;
        }
        div.main{
            padding: 8px;
            width:43vw;
            margin:1vw auto 2vw 26.5vw;
            border: 2px solid rgb(36, 23, 42);
        }
        input{
             
             padding: 15px;
             border: none;
             background: #f1f1f1;
             margin-bottom: 20px;
             /* display: inline-block; */
             margin-left: 3px;
             width: 41vw;
        
             

             
            
             
        }
        

        button{
            background-color: #17113f;
            padding: 15px;
            text-align: center;
            width: 41.9vw;
            border:none;
            margin-top: 15px;
            color:white;
        
        }
        label{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
            margin-left:2px;

            
        }
        #regiter{
            text-align: center;
            background-color: aliceblue;
            height: 30px;
            margin-top:20px ;
        }
        
    </style>
</head>
<body>
<script>
        function validate(){
            var Regname= /^[A-Za-z]+$/;
            var firstname=document.getElementById("fn").value;
            var lastname=document.getElementById("ln").value;
            var email=document.getElementById("email").value;
            var num=document.getElementById("phone").value;
            var dotpos=email.lastIndexOf(".");
            var pass=document.getElementById("pass").value;
            var cpass=document.getElementById("cpass").value;
            var atpos=email.indexOf("@");
            if(!Regname.test(firstname)){
                alert("Enter alphabets only");
                return false;
            }
            else if(!Regname.test(lastname)){
                alert("Enter a non digit last name");
                return false;
            }
            
            else if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length){
                alert("Enter a valid emailid");
                return false;
            }
            
            else if(num.length!=10){
                alert("Enter a 10 digit number");
                return false;
            }
            else if(pass!=cpass){
                alert("Confirm password is not same as password");
                return false;
            }
            

            else
            {
                return true;
                
            }
            

        }
    </script>
    <header >
        <div class="navbar">
            <div class="nav-logo border">
                <div class="logo"></div>
            </div>
            <div class="nav-home border">
                <p class="icons"><a href="index.php" class="link">HOME</a></p>
            </div>
            <div class="nav-items border">
                <p class="icons"><a href="index.php" class="link">EQUIPMENTS</a></p>
            </div>
            <div class="nav-contact border">
                <p class="icons">CONTACT US</p>
            </div>
            <div class="nav-users border">
                <p class="icons">USERS</p>
            </div>
            <div class="nav-user border" >
                <i class="fa-regular fa-user" style="margin-left:13px"></i><pre> </pre>
                <p class="sign"><a href="login.php" class="link1">LOGIN</a></p>
            </div>
            <div class="nav-login border" >
                <p class="icons"><a href="signin.php" class="link">SIGN UP</a></p>
            </div>
        </div>
    </header>
    <?php
       if($_SERVER['REQUEST_METHOD'] =='POST'){
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $cpass=$_POST['cpass'];
        // Set your connection variables
          // Set your connection variables
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "training";

// Create connection
$conn =mysqli_connect($servername,$username, $password, $db_name);

// Check connection
if (!$conn) {
    die("sorry Connection failed: ".mysqli_connect_error());
}
else{
    echo 'conneted';

// Insert into appropriate table

$hash = password_hash($pass,PASSWORD_DEFAULT);
$sql1="SELECT email FROM info WHERE email='$email'";
$result1=mysqli_query($conn,$sql1);
$num = mysqli_num_rows($result1);
if($num==1){
    echo "<script>alert('This mail already exist')</script>";

}
else{

$sql="INSERT INTO `info` (`first name`, `middle name`, `last name`, `phone number`, `email`, `password`, `confirm password`) VALUES ('$fname', '$mname', '$lname', '$phone', '$email', '$hash', '$hash')";
$result=mysqli_query($conn,$sql);
// If the connection is successful, run the query
if ($result) {
    echo "<script>alert('Record inserted successfully!')</script>";
    ;

// If the query is not successful, display the error message
}
else {
    echo "Error:";
    mysql_error($conn);
}
}
       }

}


?>
     
        
    <h1 style="text-align: center;margin-top:100px;">REGISTER</h1>
    <div class="main">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validate()">
    <label for="fname">First name:</label><br>
    <input type="text" name="fname" id="fn" placeholder="Enter your first name" required><br>
    <label for="fname">middle name:</label><br>
    <input type="text" name="mname" id="mn" placeholder="Enter your middle name" ><br>
    <label for="lname">Last name:</label><br>
    <input type="text" name="lname" id="ln" placeholder="Enter your last name" required><br>
    <label for="phone">Phone number:</label><br>
    <input type="number" name="phone" id="phone" placeholder="Enter your phone number" required><br>
    <label for="email">Email Id*(this will be your user id):</label><br>

    <input type="email" name="email" id="email" placeholder="Enter your email" required><br>
    <label for="pass">Password:</label><br>
    <input type="password" name="pass" id="pass" placeholder="Password" required><br>
    <label for="cpass">Confirm password:</label><br>
    <input type="password" name="cpass" id="cpass" placeholder="Confirm Password" required><br>
    <button type="submit"><b>SUBMIT</b></button>
    <p id="regiter">Already have an account? <a href="login.php" class="nav-login">Login</a></p>
    </form>
</div>
<footer class="last">
        <p>All rights are reserved | Design & Developed by- Panika & Radhika</p>
    </footer>
</body>
</html>