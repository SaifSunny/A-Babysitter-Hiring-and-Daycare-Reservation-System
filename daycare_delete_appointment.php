<?php
include './database/config.php';

$did = $_GET['id'];


$sql = "SELECT incare FROM hire_daycare WHERE hire_id='$did'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$incare = $row['incare'];
if($incare==1){
  echo "<script> 
  alert('Plaese Ask the User to get their Baby First.');
  window.location.href='daycare_appointments.php';
  </script>";
}else{
    $query = "DELETE FROM hire_daycare WHERE hire_id='$did'";
    $query_run = mysqli_query($conn, $query);
      if ($query_run) {
        echo "<script> 
        alert('appointment has been Deleted.');
        window.location.href='daycare_appointments.php';
        </script>";
        
      } else {
        echo "<script>alert('Cannot Delete appointment');
        window.location.href='daycare_appointments.php';
        </script>";
      }
}


?>