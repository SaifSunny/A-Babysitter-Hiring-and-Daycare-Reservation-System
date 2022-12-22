<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$sql = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['user_img'];

$_SESSION['image'] = $image;
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['username'] = $row['username'];
$zip = $row['zip'];
$user_id = $row['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Home - Kidcare</title>

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
                <h1 class="app-page-title">Dashboard</h1>
                <!-- Welcome Card-->
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
                    <div class="inner">
                        <div class="app-card-body p-3">
                            <h3 class="mb-3">Welcome, <?php echo $username?></h3>
                            <div class="row gx-5 gy-3">
                                <div class="col-12 col-lg-9">
                                    <div>Hope you are having a nice day.</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">

                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title" style="margin-left:30px;">In Babysitter Care</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">

                                    <?php 
                                            $sql = "SELECT * FROM hire_babysitter WHERE `user_id`=$user_id AND incare=1";
                                            $result = mysqli_query($conn, $sql);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                $baby_id=$row['baby_id'];
                                                $baby_name=$row['baby_name'];
                                                $baby_img=$row['baby_img'];
                                                $babysitter_name=$row['babysitter_name'];
                                                $status=$row['status'];

                                                $sql = "SELECT age FROM baby WHERE `baby_id`=$baby_id";
                                                $result = mysqli_query($conn, $sql);
                                                $row=mysqli_fetch_assoc($result);
                                                $age=$row['age'];

                                            ?>
                                    <div class="d-flex">
                                        <div><img class="profile-image" src="img/baby/<?php echo $baby_img?>" alt=""
                                                width="80px;" style="margin-right:10px;"></div>

                                        <div class="notification-meta list-inline">
                                            <h4 class="notification-title mb-1"><?php echo $baby_name?>
                                            </h4>
                                            <li class="list-inline-item">Age: <?php echo $age?></li>
                                            <br>
                                            <li class="list-inline-item">Babysitter Name:
                                                <?php echo $babysitter_name?>
                                            </li>
                                        </div>

                                        <div
                                            style="margin-left:29%;border:2px solid grey; border-radius:20%; padding:20px 30px;">
                                            <?php
                                            
                                                if($status==0){
                                                    $icon="fa-baseball-bat-ball";
                                                }elseif($status==1){
                                                    $icon="fa-bowl-food";
                                                }elseif($status==2){
                                                    $icon="fa-book";
                                                }else{
                                                    $icon="fa-bed";
                                                }

                                            ?>
                                            <i class="fa-solid <?php echo $icon?>" style="font-size:40px;"></i>
                                        </div>
                                    </div>
                                    <?php 
                                                    }
                                                }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title" style="margin-left:30px;">In Daycare</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">

                                    <?php 
                                        $sql = "SELECT * FROM hire_daycare WHERE `user_id`=$user_id AND incare=1";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                            $baby_id=$row['baby_id'];
                                            $baby_name=$row['baby_name'];
                                            $baby_img=$row['baby_img'];
                                            $babysitter_name=$row['babysitter_name'];
                                            $status=$row['status'];

                                            $sql = "SELECT age FROM baby WHERE `baby_id`=$baby_id";
                                            $result = mysqli_query($conn, $sql);
                                            $row=mysqli_fetch_assoc($result);
                                            $age=$row['age'];

                                    ?>
                                    <div class="d-flex">
                                        <div><img class="profile-image" src="img/baby/<?php echo $baby_img?>" alt=""
                                                width="80px;" style="margin-right:10px;"></div>

                                        <div class="notification-meta list-inline">
                                            <h4 class="notification-title mb-1"><?php echo $baby_name?>
                                            </h4>
                                            <li class="list-inline-item">Age: <?php echo $age?></li>
                                            <br>
                                            <li class="list-inline-item">Babysitter Name:
                                                <?php echo $babysitter_name?>
                                            </li>
                                        </div>

                                        <div
                                            style="margin-left:29%;border:2px solid grey; border-radius:20%; padding:20px 30px;">
                                            <?php
        
                                                if($status==0){
                                                    $icon="fa-baseball-bat-ball";
                                                }elseif($status==1){
                                                    $icon="fa-bowl-food";
                                                }elseif($status==2){
                                                    $icon="fa-book";
                                                }else{
                                                    $icon="fa-bed";
                                                }

                                            ?>
                                            <i class="fa-solid <?php echo $icon?>" style="font-size:40px;"></i>
                                        </div>
                                    </div>
                                    <?php 
                                                    }
                                                }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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