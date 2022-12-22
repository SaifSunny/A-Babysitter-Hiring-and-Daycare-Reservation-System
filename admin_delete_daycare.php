<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM daycare WHERE daycare_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Daycare has been Deleted.');
      window.location.href='admin_manage_daycares.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Daycare');
      window.location.href='admin_manage_daycares.php';
      </script>";
    }
?>
