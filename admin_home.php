<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['adminname'];

if (!isset($_SESSION['adminname'])) {
    header("Location: admin_login.php");
}

$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['admin_img'];

$_SESSION['image'] = $image;
$_SESSION['admin_id'] = $row['admin_id'];
$_SESSION['adminname'] = $row['username'];
$uid = $row['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Home - Kidcare</title>

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
                <h1 class="app-page-title">Dashboard</h1>
                <!-- info Card-->

                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Users</h4>
                                <?php
										$sql = "SELECT * from user";
										$result = mysqli_query($conn, $sql);
										$count = $result->num_rows;
									?>
                                <div class="stats-figure"><?php echo $count?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Babysitters</h4>
                                <?php
										$sql = "SELECT * from babysitter";
										$result = mysqli_query($conn, $sql);
										$count = $result->num_rows;
									?>
                                <div class="stats-figure"><?php echo $count?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Daycares</h4>
                                <?php
										$sql = "SELECT * from daycare";
										$result = mysqli_query($conn, $sql);
										$count = $result->num_rows;
									?>
                                <div class="stats-figure"><?php echo $count?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Toatal Hiring</h4>
                                <?php
										$sql = "SELECT * from hire_babysitter";
										$result = mysqli_query($conn, $sql);

                                        $sql1 = "SELECT * from hire_daycare";
										$result1 = mysqli_query($conn, $sql1);

										$count = $result->num_rows + $result1->num_rows;
									?>
                                <div class="stats-figure"><?php echo $count?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--//row-->

                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-4">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title" style="margin-left:30px;">Recent Users</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    <table class="table">
                                        <tbody>
                                            <?php 
												$sql = "SELECT DISTINCT `name`, `role`, `image` FROM latest_users ORDER BY id DESC LIMIT 10;";
												$result = mysqli_query($conn, $sql);
												if($result){
												while($row=mysqli_fetch_assoc($result)){
																	
													$name=$row['name'];
													$image=$row['image'];
													$role=$row['role'];

													if($role=="Admin"){
													$path= "img/admin";
													}
													elseif ($role=="Babysitter"){
													$path= "img/babysitters";
													}
													
													elseif ($role=="Daycare"){
													$path= "img/daycares";
													}
													else{
													$path= "img/users";
													}
													echo '<tr>
													<td style="font-size:14px; font-weight:600;"> <img src="./'.$path.'/'.$image.'" style="width:60px;border-radius: 20%;" alt="profile"> <span style="padding-left:20px;">'.$name.'</span></td>
													<td style="font-size:14px; font-weight:600; color:#bbb;padding-top:16px;">'.$role.'</td>
													</tr>';
												}
												}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title" style="margin-left:30px;">Verification Requests</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                <table class="table">
										<thead>
											<th>Image</th>
											<th>ID</th>
											<th>Name</th>
											<th>Experience</th>
											<th>Rate</th>
											<th>NID</th>
											<th>Status</th>
										</thead>
										<tbody>
											<?php 
												$sql = "SELECT * FROM babysitter ORDER BY sitter_id DESC LIMIT 10;";
												$result = mysqli_query($conn, $sql);
												if($result){
													while($row=mysqli_fetch_assoc($result)){
																		
													$name=$row['firstname']."  ".$row['lastname'];
													$sitter_id=$row['sitter_id'];
													$sitter_image=$row['sitter_image'];
													$experience=$row['experience'];
													$rate=$row['rate'];
													$status=$row['verification_status'];

													if($status == 1){
														$type = "success";
														$msg = "Verified";
													}else{
														$type = "danger";
														$msg = "Unverified";
													}
											?>

											<tr>
												<td style="font-size:14px; font-weight:600;"><img src="img/babysitters/<?php echo $sitter_image ?>" alt="" width="40px;"></td>
												<td style="font-size:14px; font-weight:600;"><?php echo $sitter_id ?></td>
												<td style="font-size:14px; font-weight:600;"><?php echo $name ?></td>
												<td style="font-size:14px; font-weight:600;"><?php echo $experience ?></td>
												<td style="font-size:14px; font-weight:600;"><?php echo $rate ?>
												</td>
                                                <td><a href="admin_babysitter_preview.php?sitter_id=<?php echo $sitter_id?>" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
												<td style="font-size:14px; font-weight:600;"><button
														style="border-radius: 40px; padding:5px 14px; font-size:10px; font-weight:600"
														class="btn btn-<?php echo $type?>"><?php echo $msg?></button>
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