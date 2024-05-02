
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
function build_calender($month,$year,$item){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "training";
    
     $mysqli =mysqli_connect($servername,$username, $password, $db_name);
    if (!$mysqli) {
         die("sorry Connection failed: ".mysqli_connect_error());
     }
    $stmt=$mysqli->prepare('SELECT *FROM items');
    $items="";
    $first_item=1;
    $i=0;
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows >0){
            while($row=$result->fetch_assoc()){
            if($i==0){
                $first_item=$row['item_id'];
            } 

            $items.="<option value=".$row['item_id'].">".$row['item_name']."</option>";
            $i++;
            }
        $stmt->close();
    }
    }
    if($item!=1){
        $first_item=$item ;
    }

    $mysqli= new mysqli("localhost","root","","training");
    $stmt=$mysqli->prepare('SELECT * from booking WHERE MONTH(date)=? AND YEAR(date)=? AND (item_id)=?');
    $stmt->bind_param('ssi',$month,$year,$first_item);
    $bookings=array();
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
            $bookings[]=$row['date'];
        }
        $stmt->close();
    }
    }

    $daysOfWeek=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $firstDayOfMonth=mktime(0,0,0,$month,1,$year);
    $numberDays=date('t',$firstDayOfMonth);
    $dateComponents=getdate($firstDayOfMonth);
    $monthName=$dateComponents['month'];
    $dayOfWeek=$dateComponents['wday'];
    $dateToday=date('Y-m-d');
    $prev_month=date('m',mktime(0,0,0,$month-1,1,$year));
    $prev_year=date('Y',mktime(0,0,0,$month-1,1,$year));
    $next_month=date('m',mktime(0,0,0,$month+1,1,$year));
    $next_year=date('Y',mktime(0,0,0,$month+1,1,$year));


    $calender="<center><h2>$monthName $year</h2>";
    $calender.="<a class='btn btn-primary btn-xs' style='margin-right:5px;' href='?month=".$prev_month."&year=".$prev_year."'>Prev Month </a>";

    $calender.="<a class='btn btn-primary btn-xs' style='margin-right:5px; 'href='?month=".date('m')."&year=".date('Y')."'>Current
    Month</a>";

    $calender.="<a class='btn btn-primary btn-xs' href='?month=".$next_month."&year=".$next_year."'> Next
    Month</a></center>";

    $calender.="
    <form id='items_select_form'>
    <div class='row'>
      <div class='col-md-6 col-md-offset-3 form-group'>
    
    <select class='form-control' id='items_select'  name='items'>
    ".$items."</select>
    <input type='hidden' class='form-control' name='month' value='".$month."'>
    <input type='hidden' class='form-control' name='year' value='".$year."'>

    </div>
    </div>
    </form>
    

    <table class='table table-bordered table-sm' >";
    $calender.="<tr>";
    foreach($daysOfWeek as $day){
        $calender.="<th class='header'>$day</th>";
    }
    $calender.="</tr><tr>";
    $currentDay=1;
    if($dayOfWeek>0){
        for($k=0;$k < $dayOfWeek;$k++){
            $calender.="<td class='empty'></td>";
        }
    }
    $month=str_pad($month,2,"0",STR_PAD_LEFT);
    while($currentDay <= $numberDays){ 
        if($dayOfWeek== 7){
            $dayOfWeek= 0;
            $calender.="</tr><tr>";
        }
        $currentDayRel=str_pad($currentDay,2,"0",STR_PAD_LEFT);
        $date="$year-$month-$currentDayRel";
        $dayName=strtolower(date("l",strtotime($date)));
        $today=$date==date('Y-m-d') ? 'today':'';
        if(in_array($date,$bookings)){
            $calender.="<td class='$today'><h4>$currentDay</h4> <a class='btn btn-danger btn-xs'>Already Booked</a></td>";

        }
        elseif($date<date('Y-m-d')){
            $calender.="<td class='$today'><h4>$currentDay</h4> <a class='btn btn-danger btn-xs'>N/A</a></td>";

        }
        else{
        $calender.="<td class='$today'><h4>$currentDay</h4> <a href='book2.php?date=".$date."&items=".$item."' class='btn btn-success btn-xs book'>Book</a></td>";
        }
        $currentDay++;
        $dayOfWeek++;
    }
    if($dayOfWeek<7){
        $remainingDays=7-$dayOfWeek;
        for($i=0;$i<$remainingDays;$i++){
            $calender.="<td class='empty'></td>";
        }
    }
    $calender.="</tr></table>";
    return $calender;
    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="bookstyle.css">
    
</head>
<body>
</script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $dateComponents=getdate();
                    if(isset($_GET['month']) && isset($_GET['year'])){
                        $month=$_GET['month'];
                        $year=$_GET['year'];

                    }
                    else{
                        $month=$dateComponents['mon'];
                        $year=$dateComponents['year'];
                    }

                    if(isset($_GET['items'])){
                        $item=$_GET['items'];
                    }
                    else{
                        $item=1;
                    }
                    echo build_calender($month,$year,$item);
                ?>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
        $("#items_select").change(function(){
            $("#items_select_form").submit();
        });
        $("#items_select option[value='<?php echo $item;?>']").attr('selected','selected');
        </script>
    <footer>
  <div class="text-center p-2" style="background-color: #17113f; color:white;height:60px;padding-top:25px;">
  All rights are reserved | Design by- Panika & Radhika
  </div>
  
</footer>

</body>
</html>