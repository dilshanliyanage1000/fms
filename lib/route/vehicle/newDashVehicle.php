<?php

//call the function
include_once("../../functions/vehicle.php");

$result = regDashVehicle($_POST['vin_number'],$_POST['regdnumbers'],$_POST['vehicledbrand'],$_POST['vehicledmodel'],$_POST['d_category'],$_POST['d_vehicle_description']);

echo($result);

?>