<?php
include_once("./database/config.php");

session_start();
date_default_timezone_set("Asia/Dhaka");
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$sitter_id=$_GET['id'];

$sql = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$contact = $row['contact'];
$user_id = $row['user_id'];
$user_img = $row['user_img'];
$user_name = $row['firstname']." ".$row['lastname'];

$sql1 = "SELECT * FROM babysitter WHERE sitter_id='$sitter_id'";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$rate = $row1['rate'];
$sitter_img = $row1['sitter_image'];
$sitter_name = $row1['firstname']." ".$row1['lastname'];

if(isset($_POST['submit'])){

    $hire_from = $_POST['start_date']." ".$_POST['start_time'];
    $hire_to = $_POST['end_date']." ".$_POST['end_time'];
    $message = $_POST['message'];
    $contact = $_POST['contact'];
    $baby_id = $_POST['baby_name'];

    $timestamp1 = strtotime($hire_from);
    $timestamp2 = strtotime($hire_to);
    $hour = abs($timestamp2 - $timestamp1)/(60*60);
    $total_amount = $hour*$rate;
  
    $query = "SELECT * FROM hire_babysitter WHERE user_id = '$user_id' AND baby_id = '$baby_id' AND `hire_from` = '$hire_from' AND `hire_to` = '$hire_to'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run->num_rows > 0){

            $query2 = "INSERT INTO hire_babysitter(`user_id`, babysitter_id, baby_id, user_img, babysitter_img, baby_img, `user_name`, babysitter_name, baby_name, `hire_from`, `hire_to`, `message`, `contact`,total_amount)
            VALUES ('$user_id', '$sitter_id', '$baby_id','$user_img', '$sitter_img',
            (SELECT `baby_img` FROM baby WHERE baby_id='$baby_id'), '$username', '$sitter_name',
            (SELECT `baby_name` FROM baby WHERE baby_id='$baby_id'), '$hire_from', '$hire_to','$message','$contact',$total_amount)";
            $query_run2 = mysqli_query($conn, $query2);
                    
            if ($query_run2) {
              $cls="success";
              $error = "Appointment Successfully Placed.";
            } 
            else {
              $cls="danger";
              $error = mysqli_error($conn);
            }

    }else{
        $cls="danger";
        $error ="Meeting Already Placed.";
    }
  
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Appointment - KidCare</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script src="./assets/plugins/fontawesome/js/all.min.js"></script>


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="./assets/css/portal.css">

</head>

<body class="app" style="height:100vh;">
    <!-- Header -->
    <?php include_once("./templates/user_header.php");?>
    <!-- Header -->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row gy-4">
                    <div class="col-12 col-lg-12">
                        <form action="" method="POST" enctype='multipart/form-data'>
                            <div class="row" style="padding-top:30px;">
                                <div class="col-md-12">
                                    <div class="card mx-auto" style="padding:50px 0px; ">
                                        <h5 class="card-title" style="padding-left:50px;">Book Appointment</h5>
                                        <hr>
                                        <div class="card-body" style="padding:0 60px;">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-<?php echo $cls;?>">
                                                            <?php 
                                                                if (isset($_POST['submit']) || isset($_POST['submit_img'])){
                                                                    echo $error;
                                                            }?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label style="padding-bottom:10px;">Baby Name</label>
                                                            <select name="baby_name" id="baby_name" class="form-control">
                                                            <option value="">-- Select Baby --</option>
                                                                <?php
                                                                	$sql = "SELECT * FROM baby WHERE `user_id`=$user_id";
                                                                    $result = mysqli_query($conn, $sql);
                                                                        if($result){
                                                                            while($row=mysqli_fetch_assoc($result)){
                                                                                                                    
                                                                            $baby_id=$row['baby_id'];
                                                                            $baby_name=$row['baby_name'];
                                                                ?>
                                                                <option value="<?php echo $baby_id?>"><?php echo $baby_name?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label style="padding-bottom:10px;">Contact</label>
                                                            <input type="text" class="form-control" name="contact"
                                                                id="contact" value="<?php echo $contact?>"
                                                                placeholder="Conntact" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="contact" style="padding-bottom:10px;">
                                                            Drop-off Date</label>
                                                        <input type="date" name="start_date" class="form-control"
                                                            id="start_date" placeholder="Start Date">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="contact" style="padding-bottom:10px;">
                                                        Drop-off Time</label>
                                                        <input type="time" name="start_time" class="form-control"
                                                            id="start_time" placeholder="Start Time">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="contact" style="padding-bottom:10px;">Pick-up Date
                                                            </label>
                                                        <input type="date" name="end_date" class="form-control"
                                                            id="end_date" placeholder="End Date">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="contact" style="padding-bottom:10px;">Pick-up Time</label>
                                                        <input type="time" name="end_time" class="form-control"
                                                            id="end_time" placeholder="End Time">
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="contact"
                                                        style="padding-bottom:10px;">Message</label><br>
                                                    <textarea name="message" rows="5" cols="143"
                                                        placeholder="Message (Optional)"></textarea>
                                                </div>

                                                <div class="text-end"><button class=" btn app-btn-primary"
                                                        style="margin-top:20px;" type="submit" name="submit">Book
                                                        Appointment</button></div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>

                    </form>
                    <!--//app-card-->
                </div>
                <!--//col-->

            </div>
            <!--//row-->

        </div>
        <!--//container-fluid-->
    </div>
    <!--//app-content-->
    </div>


    <!-- Javascript -->
    <script src="./assets/plugins/popper.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="./assets/plugins/chart.js/chart.min.js"></script>
    <script src="./assets/js/index-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="./assets/js/app.js"></script>

</body>

</html>