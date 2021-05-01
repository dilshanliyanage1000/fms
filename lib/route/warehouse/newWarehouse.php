<?php
//call the function
include_once("../../functions/warehouse.php");

$result = registerWarehouse($_POST['location'],$_POST['address'],$_POST['phoneone'],$_POST['phonetwo'],$_POST['description']);

echo($result);

?>