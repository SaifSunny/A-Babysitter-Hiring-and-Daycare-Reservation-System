<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE hire_babysitter SET `incare` = '2' WHERE hire_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Successfull.');
    window.location.href='babysitter_appointments.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm Request');
      window.location.href='babysitter_appointments.php';
      </script>";
  }
?>