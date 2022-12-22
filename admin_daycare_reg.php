<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['adminname'];

if (!isset($_SESSION['adminname'])) {
    header("Location: admin_login.php");
}

$daycare_id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify Daycare - Kidcare</title>

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
    <?php include_once("./templates/admin_header.php");?>
    <!-- Header -->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="d-flex justify-content-between" style="padding:20px 40px">
                    <div>
                        <h1 class="app-page-title">Verify Daycare</h1>
                    </div>
                </div>
                <!--  Card-->
                <div class="row g-4 mb-4">

                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-body p-3 p-lg-4">
                                <table class="table" style="font-size: 14px;text-align:center;">
                                    <tbody>
                                        <?php 
												$sql = "SELECT * FROM daycare WHERE daycare_id=$daycare_id ";
												$result = mysqli_query($conn, $sql);
												if($result){
													while($row=mysqli_fetch_assoc($result)){
													$id=$row['daycare_id'];
													$daycare_reg=$row['daycare_reg'];
											?>
                                        <tr>
                                            <td><img src="./img/docs/<?php echo $daycare_reg?>"
                                                    style="width:80%;" alt=""> <span
                                                    style="padding-left:20px;"></span></td>

                                        </tr>
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