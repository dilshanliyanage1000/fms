<?php
//call the function
include_once("../../functions/purchaseorders.php");

$result = getallPO($_GET['id']);

echo($result);

?>