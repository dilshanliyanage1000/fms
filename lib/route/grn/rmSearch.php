<?php
//call the function
include_once("../../functions/grn.php");

$result = rmSearchonSupplier($_GET['search'],$_GET['supplier']);

echo($result);

?>