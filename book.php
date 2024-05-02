<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
if(isset($_GET['date'])){
    $date=$_GET['date'];
    
}

if(isset($_GET['items'])){
    $item=$_GET['items'];
}
else{
    $item=1;
}
$mysqli =new mysqli('localhost','root','', 'training');

$email=$_SESSION['username'];
$stmt=$mysqli->prepare("SELECT `first name` FROM info WHERE email=?");
$stmt->bind_param('s',$email);
    $stmt->execute();
    $result=$stmt->get_result();
    $row=mysqli_fetch_assoc($result);
    $fname=$row['first name'];
    $stmt->close();
if(isset($_POST['submit'])){
    
    $place=$_POST['place'];
    $pi=$_POST['pi'];
    $item_id=$_POST['item'];
    $stmt="INSERT INTO booking (date,place,pi,fname,email,item_id)VALUES(?,?,?,?,?,?)";
    $stmtp = $mysqli->prepare($stmt);
    if ($stmtp === false) {
    die("Prepare failed: " . $mysqli->error);
     }
    $stmtp->bind_param('sssssi',$date,$place,$pi,$fname,$email,$item);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }    
    if($stmtp->execute()){
    $msg="<div class='alert alert-success'>Booking Successfull</div> ";
    
    }
    else{
       
        echo "Error executing query: " . $stmtp->error;
        $msg="<div class='alert alert-danger'>Booking Failed</div> ";
    }
    // header("location: bookindex.php");
    $stmtp->close();
    $mysqli->close();
}
// $duration=60;
// $cleanup=0;
// $start="00:00";
// $end="23:59";
// function timeslots($duration,$cleanup,$start,$end){
//     $start=new DateTime($start);
//     $end=new DateTime($end);
//     $interval= new DateInterval("PT".$duration."M");
//     $cleanupInterval= new DateInterval("PT".$cleanup."M");
//     $slots=array();
//     for($intStart=$start;$intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
//         $endPeriod=clone $intStart;
//         $endPeriod->add($interval);
//         if($endPeriod>$end){
//             break;
//         }
//         $slots[]=$intStart->format("H:iA")."-".$endPeriod->format("H:iA");
//     }
//     return $slots;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="bookstyle.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Book For Date: <?php echo date('d/m/Y',strtotime($date));?></h1><hr>
        <div class="row">
           
    <!-- Button trigger modal -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Booking:<span id="slot"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
      <div class="col-md-6 col-md-offset-3">
                <?php echo isset($msg)?$msg:'';?>

                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <!-- <label for="timeslot">Timeslot</label>
                        <input type="text" readonly name="timeslot" id="timeslot"> -->
        <!-- </div> -->
        <!-- <div class="form-group"> -->

                    <label for="place">Fname:</label>
                        <input type="text" readonly class="form-control" name="fname" value="<?php echo $fname;?>" >
        <!-- </div>
        <div class="form-group"> -->

                    <label for="place">email:</label>
                        
                        <input type="text" readonly class="form-control" name="email" value="<?php echo $_SESSION['username'];?>" >
        <!-- </div>
        <div class="form-group"> -->

                        <label for="place">Item id:</label>
                        <input type="text" readonly class="form-control" name="item" value="<?php echo $item;?>" >
        <!-- </div>
        <div class="form-group"> -->

                        <label for="place">Place of vist:</label>
                        <!-- <input type="text-area" class="form-control" name="text1"> -->
                        <textarea name="place" rows="4" cols="50" class="form-control" maxlength='200' required></textarea>
        <!-- </div>
        <div class="form-group"> -->

                        <label for="pi">Name of PI:</label>
                        <!-- <input type="text-area" class="form-control" name="text1"> -->
                        <textarea name="pi" rows="4" cols="50" class="form-control" maxlength='100' required></textarea>
        <!-- </div> -->
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>

                </form>
            </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
   
</div>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
$(".book").click(function(){
    var timeslot=$(this).attr('data-timeslot');
    $("#slot").html(timeslot);
    $("#timeslot").val(timeslot);
    $("#exampleModalCenter").modal("show");
})
</script> -->
    
</body>
</html>
