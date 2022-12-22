<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['sittername'];

if (!isset($_SESSION['sittername'])) {
    header("Location: babysitter_login.php");
}

$sql = "SELECT * FROM babysitter WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['sitter_image'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$birthday=$row['birthday'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];
$sitter_id=$row['sitter_id'];

$experience=$row['experience'];
$about_me=$row['about_me'];
$rate=$row['rate'];
$nid_image=$row['nid_image'];

if (isset($_POST['submit_img'])) {

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "img/babysitters/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

        // Upload file
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents('img/babysitters/'.$name));
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Update Record
            $query2 = "UPDATE babysitter SET `sitter_image`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            $query3 = "UPDATE `latest_users` SET `image`='$name' WHERE `name`='$username'";
            $query_run3 = mysqli_query($conn, $query3);

            if ($query_run2 && $query_run3) {
                echo "<script> alert('Profile Image Successfully Updated.');
                window.location.href='babysitter_home.php';</script>";
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

if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender=$_POST['gender'];
    $birthday=$_POST['birthday'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];

    $experience=$_POST['experience'];
    $about_me=$_POST['about_me'];
    $rate=$_POST['rate'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE babysitter SET firstname='$firstname',lastname='$lastname',
        birthday='$birthday', gender='$gender', contact='$contact',email='$email',
        `address`='$address', city='$city', zip='$zip',experience='$experience',about_me='$about_me',rate='$rate' WHERE username='$username'";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Profile Successfully Updated.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }

}

if (isset($_POST['submit_nid'])) {


    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "img/docs/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

        // Upload file
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents('img/docs/'.$name));
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Update Record
            $query2 = "UPDATE babysitter SET `nid_image`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            if ($query_run2) {
                $cls="success";
                $error = "Thank you For your Submission";
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
    <script defer src="./assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="./assets/css/portal.css">

</head>

<body class="app">
    <!-- Header -->
    <?php include_once("./templates/babysitter_header.php");?>
    <!-- Header -->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row gy-4">
                    <div class="col-12 col-lg-12">
                        <div class="row" style="padding-top:30px;">
                            <div class="col-md-4">
                                <div class="card mx-auto"
                                    style="text-align:center;padding-top:30px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                                    <h4 class="card-title" style="padding:20px 0;">My Profile</h4>
                                    <div class="card-body">
                                        <div class="row">
                                            <form action="" method="POST" enctype='multipart/form-data'>

                                                <div class="col-md-12">
                                                    <div class="col-md-12" style="width: 250px; height: 250px;">
                                                        <img src="./img/babysitters/<?php echo $image;?>" width="100%"
                                                            height="100%"
                                                            style="text-align:center; margin-left:60px;border-radius:50%; border: 5px solid #5c85c;">
                                                    </div>
                                                    <div class="col-md-12"
                                                        style="padding-top:20px;color:#222;font-weight:500;">
                                                        <label for="file" class="form-label">Profile Image</label>
                                                        <div class="d-flex justify-content-center"
                                                            style="padding-top:10px; padding-left:70px;">
                                                            <input type="file" name="file" id="file">

                                                        </div>

                                                        <div class="d-flex justify-content-center"
                                                            style="padding-top:10px;">
                                                            <button type="submit" name="submit_img"
                                                                class="btn btn-success"
                                                                style="margin-top:10px;color:white;"><i
                                                                    class="fa fa-edit"></i> Update
                                                                Image</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                        if(empty($nid_image))
                                        {
                                    ?>
                                <div class="card mx-auto"
                                    style="text-align:center;padding-top:30px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); margin-top:30px;">
                                    <h4 class="card-title" style="padding:20px 0;">NID Image</h4>
                                    <div class="card-body">
                                        <form action="" method="POST" enctype='multipart/form-data'>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12"
                                                        style="padding-top:20px;color:#222;font-weight:500;">
                                                        <div class="d-flex justify-content-center"
                                                            style="padding-left:70px;">
                                                            <input type="file" name="file" id="file">
                                                        </div>

                                                        <div class="d-flex justify-content-center"
                                                            style="padding-top:20px;">
                                                            <button type="submit" name="submit_nid"
                                                                class="btn btn-success"
                                                                style="margin-top:10px;color:white;"><i
                                                                    class="fa fa-edit"></i> Add
                                                                Image</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                                        }
                                    ?>
                            </div>
                            <div class="col-md-8">
                                <div class="card mx-auto"
                                    style="text-align:center;padding:50px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);margin-bottom:50px;">
                                    <h5 class="card-title">Personal Information</h5>
                                    <div class="card-body" style="padding:0 60px;color:#222;font-weight:500;">
                                        <form action="" method="POST" enctype='multipart/form-data'>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-<?php echo $cls;?>">
                                                        <?php 
                                                    if (isset($_POST['submit']) || isset($_POST['submit_img'])|| isset($_POST['submit_nid'])){
                                                        echo $error;
                                                }?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="padding-top:30px">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">First Name</label>
                                                        <input type="text" class="form-control" name="firstname"
                                                            id="firstname" value="<?php echo $firstname?>"
                                                            placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Last Name</label>
                                                        <input type="text" class="form-control" name="lastname"
                                                            id="lastname" value="<?php echo $lastname?>"
                                                            placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Date of Birth</label>
                                                        <input type="date" class="form-control" name="birthday"
                                                            id="birthday" value="<?php echo $birthday?>"
                                                            placeholder="Birthday" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Gender</label>
                                                        <input type="text" class="form-control" name="gender"
                                                            id="gender" value="<?php echo $gender?>"
                                                            placeholder="Gender" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Contact</label>
                                                        <input type="text" class="form-control" name="contact"
                                                            id="contact" value="<?php echo $contact?>"
                                                            placeholder="Contact" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Email</label>
                                                        <input type="text" class="form-control" name="email" id="email"
                                                            value="<?php echo $email?>" placeholder="Email Address"
                                                            required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Address</label>
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" value="<?php echo $address?>"
                                                            placeholder="Address" required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">City</label>
                                                        <input type="text" class="form-control" name="city" id="city"
                                                            value="<?php echo $city?>" placeholder="City" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Zip</label>
                                                        <input type="text" class="form-control" name="zip" id="zip"
                                                            value="<?php echo $zip?>" placeholder="Zip" required>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Experience</label>
                                                        <input type="text" class="form-control" name="experience"
                                                            id="experience" value="<?php echo $experience?>"
                                                            placeholder="Experience(Years/Months)" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">Rate</label>
                                                        <input type="text" class="form-control" name="rate" id="rate"
                                                            value="<?php echo $rate?>" placeholder="Rate" required>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label style="padding-bottom:10px;">About Me</label><br>
                                                        <textarea name="about_me" id="about_me" cols="84" rows="6"
                                                            required
                                                            style="border-color:grey"><?php echo $about_me?></textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end" style="padding-top:10px;">
                                                <button type="submit" name="submit" class="btn btn-success"
                                                    style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                                    Update</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
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
    <!--//app-wrapper-->


    <!-- Javascript -->
    <script src="./assets/plugins/popper.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="./assets/js/app.js"></script>

</body>

</html>