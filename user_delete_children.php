<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM baby WHERE baby_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Baby has been Deleted.');
      window.location.href='user_children.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Baby');
      window.location.href='user_children.php';
      </script>";
    }
?>
