<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

$result = SearchCus($_GET['data']);

echo($result);

?>