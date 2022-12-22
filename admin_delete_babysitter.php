<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM babysitter WHERE sitter_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Babysitter has been Deleted.');
      window.location.href='admin_manage_babysitters.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Babysitter');
      window.location.href='admin_manage_babysitters.php';
      </script>";
    }
?>
