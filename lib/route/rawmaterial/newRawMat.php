<?php
//call the function
include_once("../../functions/rawmaterial.php");

$result = rawmatRegistration($_POST['rm_name'],$_POST['rm_reorder_level'],$_POST['rm_description']);

echo($result);

?>