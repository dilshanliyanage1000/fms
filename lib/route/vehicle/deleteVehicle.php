<?php
    //include vehicle function
    include_once('../../functions/vehicle.php');

    $result = delVehicle($_GET['id']);  
    
    echo($result);
    
?>