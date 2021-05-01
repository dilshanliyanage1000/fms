<?php
//call the function
include_once("../../functions/grn.php");

$result = getRMforGRN($_GET['id']);

echo($result);

?>