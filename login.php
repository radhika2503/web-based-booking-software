<?php
// Initialize the session

 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
require_once "connection.php";  
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter email.";
    } else{
        $username = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["pass"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["pass"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT email, password FROM info WHERE email = ?";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
//execute query
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                //find row in database and verify

                if(mysqli_stmt_num_rows($stmt) == 1){                    
            //conversion hashed password
                    mysqli_stmt_bind_result($stmt,$username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                        
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);


?>
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
            margin:15vw auto 12vw 26.5vw;
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
            margin-top: 5px;
        }
        
    </style>
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
                alert("Enter a non digit first name");
                return false;
            }
            else if(!Regname.test(lastname)){
                alert("Enter a non digit last name");
                return false;
            }
            
            else if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length){
                alert("Enter a valid email");
                return false;
            }
            
            else if(num.length!=10){
                alert("Enter a 10 digit number");
                return false;
            }
            else if(pass!=cpass){
                alert("Confirm password is not same as passord");
                return false;
            }
            

            else{
                return true;
            }
            

        }
    </script>
</head>
<body>
    <header >
        <div class="navbar">
            <div class="nav-logo border">
                <div class="logo"></div>
            </div>
            <div class="nav-home border">
                <p class="icons"><a class="link" href="index.php">HOME</a></p>
            </div>
            <div class="nav-items border">
                <p class="icons">EQUIPMENTS</p>
            </div>
            <div class="nav-contact border">
                <p class="icons">CONTACT US</p>
            </div>
            <div class="nav-users border">
                <p class="icons">USERS</p>
            </div>
            <div class="nav-user border" >
                <i class="fa-regular fa-user" style="margin-left:13px"></i><pre> </pre>
                <p class="sign"><a class="link1" href="login.php">LOGIN</a></p>
            </div>
            <div class="nav-login border" >
                <p class="icons"><a href="signin.php" class="link">SIGN UP</a></p>
            </div>
        </div>
    </header> 
      
     <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

    <div class="main">
    <form action="recheck.php" method="POST" onsubmit="return validate()">

    <label for="email">Email Id:</label><br>
    <input type="email" name="email" id="email" placeholder="Enter your email" required><br>
    <label for="pass">Password:</label><br>
    <input type="password" name="pass" id="pass" placeholder="Password" required><br>
    
    <button type="submit"><b>SUBMIT</b></button>
   

    </form>
</div>
<footer class="last">
        <p>All rights are reserved | Design by- Panika & Radhika</p>
    </footer>
</body>
</html>