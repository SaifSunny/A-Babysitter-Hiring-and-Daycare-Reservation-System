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
$uid = $row['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daycares - Kidcare</title>

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
                <h1 class="app-page-title">Daycares</h1>

                <div class="row">
                    <?php
						$sql = "SELECT * FROM daycare WHERE `verification_status` ='1'";
						$result = mysqli_query($conn, $sql);
						if($result){
							while($row=mysqli_fetch_assoc($result)){
													
								$name= $row['daycare_name'];
								$image=$row['image'];
								$daycare_id=$row['daycare_id'];
								$rate=$row['rate'];
								$city=$row['city'];
								$about=$row['about'];
								$established=$row['established'];
					?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <a href="user_daycare_profile.php?id=<?php echo $daycare_id?>"><img class="img-fluid"
                                    src="img/daycares/<?php echo $image?>" alt=""></a>
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>
                                        &nbsp;<?php echo $city?></small>
                                    <small class="m-0"><i class="fa fa-check text-primary mr-2"></i>
                                        &nbsp;Verified</small>
                                </div>
                                <a class="h5 text-decoration-none"
                                    href="user_daycare_profile.php?id=<?php echo $daycare_id?>"><?php echo $name?></a><br>
                                <small class="m-0"><span style="color:#7AB730;font-weight:500;">Established:
                                    </span><?php echo $established?> </small><br>
                                <small class="m-0"><?php echo substr($about, 0, 100)?></small>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <?php
                                        $sql1 = "SELECT * FROM daycare_ratings WHERE daycare_id = '$daycare_id'";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $count = $result1->num_rows;
                        
                                        $query2 = "SELECT AVG(rating) AS average FROM daycare_ratings WHERE daycare_id = '$daycare_id'";
                                        $result2 = mysqli_query($conn, $query2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $avg = $row2['average'];
                                    ?>
                                        <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>
                                            <?php echo strlen(substr(strrchr($avg, "."), 2))?>
                                            <small>(<?php echo $count?>) Ratings</small>
                                        </h6>
                                        <h6 class="m-0">Tk. <?php echo $rate?>/month</h6>
                                    </div>
                                </div>
                            </div>
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