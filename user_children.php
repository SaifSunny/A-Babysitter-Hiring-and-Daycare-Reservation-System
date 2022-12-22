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
                <h1 class="app-page-title">My Children</h1>

                <div class="row g-4 mb-4">

                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title" style="margin-left:30px;">Baby Information</h4>
                                    </div>
                                    <div class="col-auto">
                                        <a href="user_add_baby.php" class="btn btn-success"
                                            style="color:white;margin-right:30px;"><i class="fa fa-plus"></i> Add
                                            Baby</a>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <table>
                                        <tbody>
                                            <?php 
                                            $sql = "SELECT * FROM baby WHERE `user_id`=$user_id";
                                            $result = mysqli_query($conn, $sql);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                $id=$row['baby_id'];
                                                $baby_name=$row['baby_name'];
                                                $baby_img=$row['baby_img'];
                                                $about=$row['about'];
                                                $age=$row['age'];

                                        ?>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex">
                                                    <img class="profile-image"
                                                        style="margin-bottom:30px;margin-right:20px;margin-left:20px;"
                                                        src="img/baby/<?php echo $baby_img?>" alt="" width="80px;">
                                                    <div class="notification-meta list-inline">
                                                        <h4 class="notification-title mb-1"><?php echo $baby_name?></h4>
                                                        <li class="list-inline-item">Age: <?php echo $age?>

                                                    </div>
                                                    <div class="notification-meta list-inline" style="padding-left:110px;">
                                                        <h6>About <?php echo $baby_name?></h6>
                                                        <li class="list-inline-item"><?php echo $about?></li>

                                                    </div>
                                                </div>


                                                <div>
                                                    <a href="user_delete_children.php?id=<?php echo $id?>" class="btn btn-danger"
                                                        style="color:white;"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>


                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
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