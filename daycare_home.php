<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['daycarename'];

if (!isset($_SESSION['daycarename'])) {
    header("Location: daycare_login.php");
}

$sql = "SELECT * FROM daycare WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['image'];

$_SESSION['image'] = $image;
$_SESSION['daycare_id'] = $row['daycare_id'];
$_SESSION['username'] = $row['username'];

$daycare_id = $row['daycare_id'];

if (isset($_POST['submit_play'])) {

    // Update Record
    $query2 = "UPDATE hire_daycare SET status=0 WHERE daycare_id='$daycare_id' AND incare=1";
    $query_run2 = mysqli_query($conn, $query2);
        
    if ($query_run2) {
        $cls="success";
        $error = "Status Successfully Updated.";
    } 
    else {
        $cls="danger";
        $error = mysqli_error($conn);
    }

}

if (isset($_POST['submit_food'])) {

    // Update Record
    $query2 = "UPDATE hire_daycare SET status=1 WHERE daycare_id='$daycare_id' AND incare=1";
    $query_run2 = mysqli_query($conn, $query2);
        
    if ($query_run2) {
        $cls="success";
        $error = "Status Successfully Updated.";
    } 
    else {
        $cls="danger";
        $error = mysqli_error($conn);
    }

}
if (isset($_POST['submit_book'])) {

    // Update Record
    $query2 = "UPDATE hire_daycare SET status=2 WHERE daycare_id='$daycare_id' AND incare=1";
    $query_run2 = mysqli_query($conn, $query2);
        
    if ($query_run2) {
        $cls="success";
        $error = "Status Successfully Updated.";
    } 
    else {
        $cls="danger";
        $error = mysqli_error($conn);
    }

}
if (isset($_POST['submit_bed'])) {

    // Update Record
    $query2 = "UPDATE hire_daycare SET status=3 WHERE daycare_id='$daycare_id' AND incare=1";
    $query_run2 = mysqli_query($conn, $query2);
        
    if ($query_run2) {
        $cls="success";
        $error = "Status Successfully Updated.";
    } 
    else {
        $cls="danger";
        $error = mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daycare Home - Kidcare</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script src="./assets/plugins/fontawesome/js/all.min.js"></script>


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="./assets/css/portal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="app" style="height:100vh;">
    <!-- Header -->
    <?php include_once("./templates/daycare_header.php");?>
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

                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title" style="margin-left:30px;">Babies Incare</h4>
                                    </div>
                                    <div class="col-auto">
                                        <form action="" method="POST">
                                            <button type="submit" name="submit_play" class="btn btn-primary" style="color:white;">Playing</button>
                                            <button type="submit" name="submit_food" class="btn btn-primary" style="color:white;">Eating</button>
                                            <button type="submit" name="submit_book" class="btn btn-primary" style="color:white;">Studying</button>
                                            <button type="submit" name="submit_bed" class="btn btn-primary" style="color:white;">Sleeping</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <?php 
                                            $sql = "SELECT * FROM hire_daycare WHERE `daycare_id`=$daycare_id AND incare=1";
                                            $result = mysqli_query($conn, $sql);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                $baby_id=$row['baby_id'];
                                                $baby_name=$row['baby_name'];
                                                $baby_img=$row['baby_img'];
                                                $user_name=$row['user_name'];
                                                $status=$row['status'];
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
                                            <li class="list-inline-item">Dropped By:
                                                <?php echo $user_name?>
                                            </li>
                                        </div>

                                        <div style="margin-left:70%;border:2px solid grey; border-radius:20%; padding:20px 30px;">
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