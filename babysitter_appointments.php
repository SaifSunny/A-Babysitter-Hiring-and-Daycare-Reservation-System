<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['sittername'];
$sitter_id = $_SESSION['sitter_id'];

if (!isset($_SESSION['sittername'])) {
    header("Location: babysitter_login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Appointments - Kidcare</title>

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
    <?php include_once("./templates/babysitter_header.php");?>
    <!-- Header -->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Babysitter Appointments</h1>

                <div class="col-12 col-lg-12">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="chart-container">
                                <table>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM hire_babysitter WHERE `babysitter_id`=$sitter_id AND incare=0 OR incare=1";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                                    
                                                $name=$row['user_name'];
                                                $image=$row['user_img'];
                                                $sitter_id=$row['user_id'];
                                                $hire_from=$row['hire_from'];
                                                $hire_to=$row['hire_to'];
                                                $total_amount=$row['total_amount'];
                                                $baby_name=$row['baby_name'];
                                                $hire_id=$row['hire_id'];
                                        ?>
                                        <tr>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex">
                                                    <img class="profile-image" src="img/users/<?php echo $image?>"
                                                        alt="" width="130px;" height="130px;"
                                                        style="margin-right:30px;">
                                                    <div>
                                                        <h4 class="notification-title mb-1"><?php echo $name?>
                                                        </h4>
                                                        <ul class="notification-meta list-inline"
                                                            style="padding:0;margin:0;">
                                                            <li class="list-inline-item">Hire From:
                                                                <?php echo $hire_from?> | Hire To: <?php echo $hire_to?>
                                                                <br>
                                                                Baby Name: <?php echo $baby_name?>
                                                            </li>
                                                            <li>Total Amount: <?php echo $total_amount?></li>
                                                        </ul>

                                                    </div>
                                                </div>

                                                <div>
                                                    <a href="babysitter_drop_off.php?id=<?php echo $hire_id?>" class="btn btn-warning" style="color:white;">Droped-off</a>
                                                    <a href="babysitter_pick_up.php?id=<?php echo $hire_id?>" class="btn btn-success" style="color:white;">Picked-up</a>
                                                    <a href="babysitter_delete_appointment.php?id=<?php echo $hire_id?>" class="btn btn-danger"
                                                        style="color:white;margin-left:10px;"><i
                                                            class="fa fa-trash"></i></a>
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