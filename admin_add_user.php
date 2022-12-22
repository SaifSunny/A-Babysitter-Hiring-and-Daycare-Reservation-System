<?php
include_once("./database/config.php");

session_start();
date_default_timezone_set("Asia/Dhaka");

$username = $_SESSION['adminname'];

if (!isset($_SESSION['adminname'])) {
    header("Location: admin_login.php");
}


$admin_id=$_SESSION['admin_id'];

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    $date = date("Y-m-d");


    $p = $_POST['password'];
    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "img/users/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    if (strlen($p) > 5) {
    
        $query = "SELECT * FROM user WHERE username = '$username'";
        $query_run = mysqli_query($conn, $query);
        if (!$query_run->num_rows > 0) {

            $query = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";
            $query_run = mysqli_query($conn, $query);
            if(!$query_run->num_rows > 0){

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){

                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                        // Convert to base64 
                        $image_base64 = base64_encode(file_get_contents('img/users/'.$name));
                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                        // Insert record

                        $query2 = "INSERT INTO user(username,email,`password`,firstname,lastname,contact,gender,birthday,user_img, `address`, city, zip)
                        VALUES ('$username', '$email', '$password', '$firstname', '$lastname', '$contact', '$gender', '$birthday', '$name', '$address', '$city', '$zip')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            $cls="success";
                            $error = "User Successfully Added.";
                        } 
                        else {
                            $cls="danger";
                            $error = mysqli_error($conn);
                        }

                    }else{
                        $cls="danger";
                        $error = 'Unknown Error Occurred.';
                    }
                }else{
                    $cls="danger";
                    $error = 'Invalid File Type';
                }
            }
            else{
                $cls="danger";
                $error = "User Already Exists";
            }
            
        }else{
            $cls="danger";
            $error = "Username Already Exists";
        }
    }else{
        $cls="danger";
        $error = 'Password has to be minimum of 6 charecters.';
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add User - Kidcare</title>

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
                        <h1 class="app-page-title">Add Users</h1>
                    </div>
                </div>
                <!--  Card-->
                <div class="row g-4 mb-4">

                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-body p-3 p-lg-4">
                                <form action="" method="POST" enctype='multipart/form-data' style="padding:0 40px">
                                    <div class="row" style="color:#222;">
                                        <div class="col-md-12">

                                            <div class="alert alert-<?php echo $cls;?>">
                                                <?php 
                                                            if (isset($_POST['submit'])){
                                                                echo $error;
                                                            }
                                                        ?>
                                            </div>
                                            <div class="row" class="d-flex justify-content-between">
                                                <div class="col-md-9">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:20px;">Profile Image</label>
                                                        <input type="file" name="file" id="file" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="col-md-12" style="width: 150px; height: 150px;">
                                                        <img src="./img/users/default.png" width="100%" height="100%"
                                                            style="text-align:center; margin-left:30px;">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">First Name</label>
                                                            <input type="text" class="form-control" name="firstname"
                                                                id="firstname" placeholder="First Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Last Name</label>
                                                            <input type="text" class="form-control" name="lastname"
                                                                id="lastname" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
													<div class="form-group" style="padding:10px">
														<label style="padding-bottom:20px;">Birthday</label>
														<input type="date" class="form-control" name="birthday"
															id="birthday" placeholder="Birthday">
													</div>
												</div>
                                                
                                                <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Gender</label>
                                                            <select class="form-control" name="gender" id="gender"
                                                                placeholder="Gender" required>
                                                                <option>-- Select Gender --</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Email</label>
                                                            <input type="text" class="form-control" name="email"
                                                                id="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Contact</label>
                                                            <input type="text" class="form-control" name="contact"
                                                                id="contact" placeholder="Contact">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Username</label>
                                                            <input type="text" class="form-control" name="username"
                                                                id="username" placeholder="Username">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Password</label>
                                                            <input type="text" class="form-control" name="password"
                                                                id="password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Address</label>
                                                            <input type="text" class="form-control" name="address"
                                                                id="address" placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">City</label>
                                                            <input type="text" class="form-control" name="city"
                                                                id="city" placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding:10px">
                                                            <label style="padding-bottom:20px;">Zip</label>
                                                            <input type="text" class="form-control" name="zip" id="zip"
                                                                placeholder="Zip">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end" style="padding-top:20px;">
                                                    <button type="submit" name="submit" class="btn app-btn-primary"
                                                        style="margin-right:10px;">&nbsp;&nbsp;Add
                                                        User</button>
                                                </div>


                                            </div>


                                        </div>

                                </form>
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