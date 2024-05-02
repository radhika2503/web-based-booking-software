<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_GET['items'])) {
    $item = $_GET['items'];
} else {
    $item = 1;
}
$mysqli = new mysqli('localhost', 'root', '', 'training');

$email = $_SESSION['username'];
$stmt = $mysqli->prepare("SELECT `first name` FROM info WHERE email=?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$fname = $row['first name'];
$stmt->close();

if (isset($_POST['submit'])) {

    $place = $_POST['place'];
    $pi = $_POST['pi'];
    $item_id = $_POST['item'];
    $stmt = "INSERT INTO booking (date,place,pi,fname,email,item_id) VALUES (?,?,?,?,?,?)";
    $stmtp = $mysqli->prepare($stmt);
    if ($stmtp === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmtp->bind_param('sssssi', $date, $place, $pi, $fname, $email, $item);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    if ($stmtp->execute()) {
        $msg = "<div class='alert alert-success'>Booking Successful</div> ";
    } else {
        echo "Error executing query: " . $stmtp->error;
        $msg = "<div class='alert alert-danger'>Booking Failed</div> ";
    }
    $stmtp->close();
    $mysqli->close();
}

$duration = 60;
$cleanup = 0;
$start = "00:00";
$end = "23:59";

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();
    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if ($endPeriod > $end) {
            break;
        }
        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }
    return $slots;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Slot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="bookstyle.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Book For Date: <?php echo date('d/m/Y', strtotime($date)); ?></h1>
        
        <div class="row">
            <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
            foreach ($timeslots as $ts) {
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-success book" data-timeslot="<?php echo $ts ?>"><?php echo $ts ?></button>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="modal fade" id="ModalCenter"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h2 class="modal-title text-center">Slot- <span id="slot"></span></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    <!-- <div class="col-md-12"> -->
                        <!-- <div>BOOKING DETAILS</div> -->
                        <form action="" method="post" autocomplete="off" name='myform'>
                            <div class="form-group">
                                <label for="">Timeslot:</label>
                                <input type="text" readonly name="timeslot" value="<?php echo $ts ;?>" id="timeslot" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="place">Fname:</label>
                                <input type="text" readonly class="form-control" name="fname" value="<?php echo $fname;?>" >
                            </div>
                            <div class="form-group">
                                <label for="place">Email:</label>
                                <input type="text" readonly class="form-control" name="email" value="<?php echo $_SESSION['username'];?>" >
                            </div>
                            <div class="form-group">
                                <label for="place">Item id:</label>
                                <input type="text" readonly class="form-control" name="item" value="<?php echo $item;?>" >
                            </div>
                            <div class="form-group">
                                <label for="place">Place of visit:</label>
                                <textarea name="place" rows="4" cols="50" class="form-control" maxlength='200' required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pi">Name of PI:</label>
                                <textarea name="pi" rows="4" cols="50" class="form-control" maxlength='100' required></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                        </form>
                    <!-- </div> -->
                </div>
                <div class="modal-footer"> 
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(".book").click(function () {
            var timeslot = $(this).attr('data-timeslot');
            $("#slot").html(timeslot);
            $("#timeslot").val(timeslot);
            $("#ModalCenter").modal("show").addClass("fade");
        });
    </script>
</body>
</html>
