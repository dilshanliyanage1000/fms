<?php
    //include vehicle function
    include_once('../../functions/vehicle.php');

    $result = reactivateVehicle($_GET['id']);  
    
    echo($result);
    
?>