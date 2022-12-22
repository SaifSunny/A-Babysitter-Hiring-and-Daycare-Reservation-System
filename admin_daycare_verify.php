<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE daycare SET `verification_status` = '1' WHERE daycare_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Verification Successfull.');
    window.location.href='admin_verify_daycare.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm verification Request');
      window.location.href='admin_verify_daycare.php';
      </script>";
  }
?>