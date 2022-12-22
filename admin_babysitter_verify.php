<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE babysitter SET `verification_status` = '1' WHERE sitter_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Verification Successfull.');
    window.location.href='admin_verify_babysitter.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm verification Request');
      window.location.href='admin_verify_babysitter.php';
      </script>";
  }
?>