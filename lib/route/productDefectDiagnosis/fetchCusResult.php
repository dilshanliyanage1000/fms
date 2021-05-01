<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

$result = CusData($_GET['id']);

echo($result);

?>