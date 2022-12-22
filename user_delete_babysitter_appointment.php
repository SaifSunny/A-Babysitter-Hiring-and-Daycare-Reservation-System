<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM hire_babysitter WHERE hire_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('appointment has been Deleted.');
      window.location.href='user_babysitter_appointments.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete appointment');
      window.location.href='user_babysitter_appointments.php';
      </script>";
    }
?>
