<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

$result = ProdData($_GET['id']);

echo($result);

?>