<?php
    $login=false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'connection.php';
        $username = $_POST["email"];
        $password = $_POST["pass"]; 
    
    $sql = "Select * from info where email='$username'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if ($num == 1){

        while($row=mysqli_fetch_assoc($result)){
            

            if (password_verify($password, $row['password'])){ 
            
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php");
            } 
            else{
                echo "Invalid Password";
            }
        }
    }

            else{
                echo "Invalid login-id and Password";
                
            }
        }
    

?>