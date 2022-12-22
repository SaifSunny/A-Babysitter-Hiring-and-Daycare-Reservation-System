<?php
include_once("./database/config.php");

session_start();
date_default_timezone_set("Asia/Dhaka");
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$hire_id=$_GET['id'];

$sql = "SELECT * FROM hire_babysitter WHERE hire_id='$hire_id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$user_id = $row['user_id'];
$user_img = $row['user_img'];
$user_name= $row['user_name'];

$babysitter_id = $row['babysitter_id'];
$babysitter_img = $row['babysitter_img'];
$babysitter_name= $row['babysitter_name'];



if(isset($_POST['submit'])){

    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
  
    $query = "SELECT * FROM babysitter_ratings WHERE hire_id = '$hire_id'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run->num_rows > 0){
        $query2 = "INSERT INTO babysitter_ratings(hire_id,`user_id`, babysitter_id, user_img, babysitter_img, `user_name`, babysitter_name, `rating`, `comment`)
        VALUES ('$hire_id','$user_id', '$babysitter_id', '$user_img', '$babysitter_img', '$user_name', '$babysitter_name','$rating','$comment')";
        $query_run2 = mysqli_query($conn, $query2);
                
        if ($query_run2) {
            echo "<script> 
            alert('Rating Successfull');
            window.location.href='user_babysitter_appointments.php';
            </script>";
        } 
        else {
          $cls="danger";
          $error = mysqli_error($conn);
        }
           

    }else{
        $query2 = "UPDATE babysitter_ratings SET rating = '$rating', comment='$comment' WHERE hire_id='$hire_id'";
        $query_run2 = mysqli_query($conn, $query2);
                
        if ($query_run2) {
          $cls="success";
          $error = "Rating Successfully Updated.";
        } 
        else {
          $cls="danger";
          $error = mysqli_error($conn);
        }
    }
  
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rate Babysitter - KidCare</title>

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
                                    <div class="card mx-auto" style="padding:50px 0px; padding-left:40px;">
                                        <h5 class="card-title" style="padding-left:50px;">Rate Babysitter</h5>
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
                                                <label for="rating" style="padding-bottom:20px;">Rate the Babysitter</label>

                                                <div class="row">
                                                    <div class="rating" style="font-size:20px;">
                                                        <input type="radio" id="radio" name="rating" value="5" /><label
                                                            for="star5" title="Meh" style="padding: 0 20px;">5
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="4" /><label
                                                            for="star4" title="Kinda bad" style="padding: 0 20px;">4
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="3" /><label
                                                            for="star3" title="Kinda bad" style="padding: 0 20px;">3
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="2" /><label
                                                            for="star2" title="Sucks big tim" style="padding: 0 20px;">2
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="1" /><label
                                                            for="star1" title="Sucks big time" style="padding: 0 20px;">1
                                                            star</label>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="contact"
                                                        style="padding-bottom:20px;">Comment</label><br>
                                                    <textarea name="comment" rows="5" cols="137"
                                                        placeholder="comment"></textarea>
                                                </div>

                                                <div class="text-end"><button class=" btn app-btn-primary"
                                                        style="margin-top:20px;margin-right:60px;" type="submit" name="submit">Rate Babysitter</button></div>
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