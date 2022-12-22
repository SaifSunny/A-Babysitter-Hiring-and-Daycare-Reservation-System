<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['daycarename'];
$daycare_id = $_SESSION['daycare_id'];

if (!isset($_SESSION['daycarename'])) {
    header("Location: daycare_login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment History - Kidcare</title>

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
    <?php include_once("./templates/daycare_header.php");?>
    <!-- Header -->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Appointment history</h1>

                <div class="col-12 col-lg-12">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="chart-container">
                                <table>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM hire_daycare WHERE `daycare_id`=$daycare_id AND incare=2";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                                    
                                                $name=$row['user_name'];
                                                $image=$row['user_img'];
                                                $user_id=$row['user_id'];

                                                $total_amount=$row['total_amount'];
                                                $baby_name=$row['baby_name'];
                                                $hire_id=$row['hire_id'];
                                                $age=$row['age'];
                                                $day=$row['day'];
                                        ?>
                                        <tr>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex">
                                                    <img class="profile-image" src="img/users/<?php echo $image?>"
                                                        alt="" width="130px;" height="130px;"
                                                        style="margin-right:30px;">
                                                    <div>
                                                        <div class="notification-type mb-2"><span
                                                                class="badge bg-info">daycare</span></div>
                                                        <h4 class="notification-title mb-1"><?php echo $name?>
                                                        </h4>
                                                        <ul class="notification-meta list-inline"
                                                            style="padding:0;margin:0;">
                                                            <li class="list-inline-item">
                                                                Baby Name: <?php echo $baby_name?><br>
                                                                Age: <?php echo $age?>
                                                            </li>

                                                            <li>Subscription Used: <?php echo 30 - $day?> days</li>
                                                            <li>Total Amount:
                                                                <?php echo ($total_amount/30)*(30 - $day)?></li>
                                                        </ul>

                                                    </div>
                                                </div>

                                                <div>
                                                    <?php
                                                    $query = "SELECT * FROM daycare_ratings WHERE hire_id = '$hire_id'";
                                                    $query_run = mysqli_query($conn, $query);
                                                    $row=mysqli_fetch_assoc($query_run);

                                                    if(!$query_run->num_rows > 0){
                                                    
                                                    }else{
                                                    ?> 
                                                    <a class="btn btn-warning"
                                                        style="color:white;margin-left:10px;">Rating :
                                                        <?php echo $row['rating']?> <i class="fa fa-star"></i></a>
                                                    <?php
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                        </tr>
                                        <hr>

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