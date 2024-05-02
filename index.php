
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking software</title>
    <link href="stylel.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            overflow-x: hidden;
            
        }
        input,select:focus{
            background-color: rgb(221, 246, 255);
        }
        input,select:blur{
            background-color: red;
        }
        div.main{
            padding: 8px;
            width:auto;
            margin:5vw 1vw 1vw 1vw;
            border: 2px solid rgb(36, 23, 42);
            background-color:#ADD8E6;
            
        }
        input,select{
             
             padding: 15px;
             border: none;
             background: #f1f1f1;
             margin-bottom: 20px;
             /* display: inline-block; */
             margin-left: 3px;
             margin-right:70px;
             width: 14vw;
             
        
             

             
            
             
        }
        

        button{
            background-color: #17113f;
            padding: 15px;
            text-align: center;
            width: 8vw;
            border:none;
            margin-top: 15px;
            color:white;
        
        }
        label{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
            margin-left:2px;
            margin-right:5px
            
        }
        #regiter{
            text-align: center;
            background-color: aliceblue;
            height: 30px;
            margin-top: 5px;
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
    <section>
        <div class="lab">
            <div class="lab-img"><img src="images/lab.jpg" alt="image"></div>
        </div>
    </section>
    <section>
    <div class="main">
    <form action="login.php" method="POST" onsubmit="return validate()">
    <label for="items">Select item name:</label>
    <select name="items" id="item">
             <option value="item1">item1</option>
             <option value="item2">item1</option>
             <option value="item3">item1</option>
             <option value="item4">item1</option>
             <option value="item5">item1</option>
             <option value="item6">item1</option>
    </select> 
    <label for="start">Start date</label>
    <input type="date" name="start" id="start"  required>
    <label for="end">End date</label>
    <input type="date" name="end" id="end"  required>
    
    
    <button type="submit"><b>SUBMIT</b></button>
</form>
    
    </section>
    <section id="product1" class="header">
        <div class="pro-container">
            <div class="pro">
                <img src="images/photo.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo3.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo2.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo3.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo2.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo3.jpg" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            <div class="pro">
                <img src="images/photo4.png" alt="image">
                <div class="des">
                    <span>Item 1</span>
                    <h5>Name 1</h5>
                </div>
                <a href="#" ><i class="fa-regular fa-bookmark"></i></a>
            </div>
            
        </div>

    </section>
    <footer class="last">
        <p>All rights are reserved | Design & Developed by- Team impecables</p>
    </footer>
    
    
</body>
</html>