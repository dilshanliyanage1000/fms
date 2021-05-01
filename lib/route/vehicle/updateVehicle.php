<?php
    //include the vehicle function
    
    include_once("../../functions/vehicle.php");

    $result = editVehicle($_POST['vechicleid'], $_POST['province'], $_POST['regletters'], $_POST['vin'], $_POST['regnumber'], $_POST['brand'], $_POST['model'], $_POST['category'], $_POST['description']);

    echo($result);

?>