<?php

//call the function
include_once("../../functions/vehicle.php");

$result = regSriVehicle($_POST['s_vin_number'],$_POST['regsrinumbers'],$_POST['s_vehicle_brand'],$_POST['s_vehicle_model'],$_POST['s_category'],$_POST['s_vehicle_description']);

echo($result);

?>