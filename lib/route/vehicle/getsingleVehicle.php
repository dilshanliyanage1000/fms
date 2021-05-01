<?php

    //include the function
    
    include_once("../../functions/vehicle.php");

    $result = getsingleVehicle($_GET['id']);

    echo($result);
?>