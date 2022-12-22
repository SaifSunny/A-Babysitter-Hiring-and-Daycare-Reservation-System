<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE hire_daycare SET `incare` = '0', day=day-1 WHERE hire_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Successfull.');
    window.location.href='daycare_appointments.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm Request');
      window.location.href='daycare_appointments.php';
      </script>";
  }
?>