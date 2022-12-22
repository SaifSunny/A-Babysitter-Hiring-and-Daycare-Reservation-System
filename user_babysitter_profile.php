<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$sitter_id=$_GET['id'];

$sql = "SELECT * FROM babysitter WHERE sitter_id='$sitter_id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$name=$row['firstname'] ." ". $row['lastname'];
$sitter_image=$row['sitter_image'];
$sitter_id=$row['sitter_id'];
$rate=$row['rate'];
$about_me=$row['about_me'];
$experience=$row['experience'];
$city=$row['city'];
$address=$row['address'];
$zip=$row['zip'];
$about_me=$row['about_me'];
$gender=$row['gender'];
$contact=$row['contact'];
$email=$row['email'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Babysitter Profile - KidCare</title>

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
                                <div class="col-md-4">
                                    <div class="card mx-auto"
                                        style="text-align:center;padding-top:30px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                                        <h5 class="card-title" style="padding:10px 0;">Babysitter Profile</h5>
                                        <div class="card-body" style="padding-bottom:40px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12" style="width: 200px; height: 200px;">
                                                        <img src="./img/babysitters/<?php echo $sitter_image;?>"
                                                            width="100%" height="100%"
                                                            style="text-align:center; margin-left:70px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="padding:25px 0;">
                                            <h4><?php echo $name;?></h4>
                                            <div class="ratings">
                                                <p>
                                                    <div class="d-flex justify-content-center">
                                                    <?php
                                                                                    
                                                    $sql = "SELECT * FROM babysitter_ratings WHERE babysitter_id = '$sitter_id'";
                                                    $result1 = mysqli_query($conn, $sql);
                                                    $count = $result1->num_rows;
									
                                                    $query = "SELECT AVG(rating) AS average FROM babysitter_ratings WHERE babysitter_id = '$sitter_id'";
                                                    $result = mysqli_query($conn, $query);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $avg = $row['average'];

                                                        for($i=0; $i<5; $i++){
                                                            if($i<$avg){
                                                    ?>
                                                    <i class="fa fa-star color"></i>
                                                    <?php
                                                            }else{
                                                    ?>
                                                    <i class="fa fa-star"></i> <br>

                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                    </div>


                                                    (<?php echo $count?>) Reviews

                                                </p>

                                            </div>
                                            <h6>Experience : <?php echo $experience;?></h6>
                                            <h6>Job Rate: <?php echo $rate;?> /hr</h6>

                                            <div style="padding-top:10px;">
                                                <i class="fa fa-map-marker-alt text-primary mr-2"></i>
                                                &nbsp;<?php echo $city;?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                                    class="fa fa-check text-primary mr-2"></i> &nbsp;Verified
                                            </div>
                                            <hr>
                                            <div>
                                                <a href="user_babysitter_hiring.php?id=<?php echo $sitter_id?>"
                                                    class="btn btn-primary" style="color:white;">Hire Now</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card mx-auto"
                                        style="padding:50px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                                        <h5 class="card-title" style="padding-left:50px;">Personal Information</h5>
                                        <hr>
                                        <div class="card-body" style="padding:0 60px;">

                                            <div class="row" style="padding-top:30px">
                                                <div class="col-md-12 text-left">
                                                    <div>
                                                        <h5>About:</h5>
                                                        <hr>
                                                        <?php echo $about_me;?> <br><br>
                                                        <h5>Contact Information:</h5>


                                                        <hr>
                                                        <h6>Address: <?php echo $address." ".$city."-".$zip;?></h6>
                                                        <h6>Email Address: <?php echo $email;?></h6>
                                                        <h6>Contact: <?php echo $contact;?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" style="padding-top:30px;">
                                                    <h5>Reviews</h5>
                                                    <hr><br>
                                                    <div class="chart-container">
                                                        <table>
                                                            <tbody>
                                                                <?php
                                                                    $query = "SELECT * FROM babysitter_ratings WHERE babysitter_id = '$sitter_id'";
                                                                    $result = mysqli_query($conn, $query);
                                                                    if($result){
                                                                        while($row=mysqli_fetch_assoc($result)){
                                                                        $user_id=$row['user_id'];
                                                                        $user_name=$row['user_name'];
                                                                        $user_img=$row['user_img'];
                                                                        $rating=$row['rating'];
                                                                        $comment=$row['comment'];
                                                                                                
                                                                    
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <img class="profile-image"
                                                                            src="img/users/<?php echo $user_img?>"
                                                                            alt="" width="70px;"
                                                                            style="margin-right:10px;">
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="notification-title mb-1">
                                                                            <?php echo $user_name?>
                                                                        </h4>
                                                                        <div class="ratings">
                                                                            <p>
                                                                                <?php
                                                                                    for($i=0; $i<5; $i++){
                                                                                        if($i<$rating){
                                                                                ?>
                                                                                <i class="fa fa-star color"></i>
                                                                                <?php
                                                                                        }else{
                                                                                ?>
                                                                                <i class="fa fa-star"></i> <br>
                                                                                <?php
                                                                                        }
                                                                                    }
                                                                                ?>

                                                                                <?php echo $comment?>

                                                                            </p>

                                                                        </div>
                                                                    </td>

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