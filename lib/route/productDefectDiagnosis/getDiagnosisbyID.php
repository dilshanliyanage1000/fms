<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

$result = getDiagnosisbyID($_GET['id']);

echo($result);

?>