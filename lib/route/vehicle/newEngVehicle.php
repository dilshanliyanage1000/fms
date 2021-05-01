<?php

//call the function
include_once("../../functions/vehicle.php");

$result = regEngVehicle($_POST['vehicle_province'],$_POST['reg_letters'],$_POST['reg_numbers'],$_POST['vehicle_brand'],$_POST['vehicle_model'],$_POST['category'],$_POST['vehicle_description']);

echo($result);

?>