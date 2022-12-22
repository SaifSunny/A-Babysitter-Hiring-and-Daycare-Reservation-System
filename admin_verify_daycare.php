<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['adminname'];

if (!isset($_SESSION['adminname'])) {
    header("Location: admin_login.php");
}

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
                                    <thead>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Join date</th>
                                        <th>Licence</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        <?php 
												$sql = "SELECT * FROM daycare WHERE verification_status=0";
												$result = mysqli_query($conn, $sql);
												if($result){
													while($row=mysqli_fetch_assoc($result)){
													$id=$row['daycare_id'];

													$name=$row['daycare_name'];
													$contact=$row['contact'];
													$email=$row['email'];
													$address=$row['address']." ".$row['city']."-".$row['zip'];
													$image=$row['image'];
													$join_date=$row['join_date'];
													$daycare_reg=$row['daycare_reg'];
											?>
                                        <tr>
                                            <td><img src="./img/daycares/<?php echo $image?>"
                                                    style="width:80px;border-radius: 20%;" alt="profile"> <span
                                                    style="padding-left:20px;"></span></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $contact ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $address ?></td>
                                            <td><?php echo $join_date ?></td>
                                            <td><a href="admin_daycare_reg.php?id=<?php echo $id?>"
                                                    class="btn btn-success" style="padding:8px;color:white;"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                            <td><a href="admin_daycare_verify.php?id=<?php echo $id?>"
														class="btn btn-success" style="padding:8px;color:white;"><i
															class="fa fa-check"></i></a>
															<a href="admin_delete_daycare.php?id=<?php echo $id?>"
														class="btn btn-danger" style="padding:8px;color:white;"><i
															class="fa fa-trash"></i></a>
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