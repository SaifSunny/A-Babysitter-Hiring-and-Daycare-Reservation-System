<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['username'];

$user_id= $_SESSION['user_id'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

if(isset($_POST['submit'])){

    $baby_name = $_POST['baby_name'];
    $about = $_POST['about'];
    $age = $_POST['age'];

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "img/baby/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");


            $query = "SELECT * FROM baby WHERE user_id = '$user_id' AND baby_name = '$baby_name'";
            $query_run = mysqli_query($conn, $query);
            if(!$query_run->num_rows > 0){

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){

                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                        // Convert to base64 
                        $image_base64 = base64_encode(file_get_contents('img/baby/'.$name));
                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                        // Insert record

                        $query2 = "INSERT INTO baby(baby_name ,baby_img,`about`,user_id, age)
                        VALUES ('$baby_name', '$name', '$about', '$user_id', '$age')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            $cls="success";
                            $error = "Baby Successfully Added.";
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
                $error = "Baby Already Exists";
            }

   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Add Baby - Kidcare</title>

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
                <h1 class="app-page-title">Add baby</h1>

                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-4">
                                <form action="" method="POST" enctype='multipart/form-data'>
                                    <div class="alert alert-<?php echo $cls;?>">
                                        <?php 
                                                if (isset($_POST['submit'])){
                                                    echo $error;
                                                }?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" style="padding:10px">
                                                <label style="padding-bottom:10px;">Baby Image</label>
                                                <input type="file" name="file" id="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" style="padding:10px">
                                                <label style="padding-bottom:10px;">Baby Name</label>
                                                <input type="text" class="form-control" name="baby_name" id="baby_name"
                                                    placeholder="Baby Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" style="padding:10px">
                                                <label style="padding-bottom:10px;">Age</label>
                                                <input type="text" class="form-control" name="age" id="age"
                                                    placeholder="Age">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="padding:10px">
                                                <label style="padding-bottom:10px;">Baby Image</label><br>
                                                <textarea name="about" id="about" cols="150" rows="8"
                                                    placeholder="About the Baby" style="padding:10px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end" style="padding-top:20px;">
                                        <button type="submit" name="submit" class="btn app-btn-primary"
                                            style="margin-right:10px;"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Add
                                            Baby</button>
                                    </div>
                                </form>

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