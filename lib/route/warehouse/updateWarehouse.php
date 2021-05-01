<?php
//include the warehouse function
include_once("../../functions/warehouse.php");

$result = editWarehouse($_POST['whID'], $_POST['whlocation'], $_POST['whaddress'], $_POST['whphoneone'], $_POST['whphonetwo'], 
                        $_POST['whdescription']);

echo($result);
?>