<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

$result = SearchProd($_GET['data']);

echo($result);

?>