<?php
//call the function
include_once("../../functions/productDefectDiagnosis.php");

$result = getimglistbyID($_GET['id']);

echo($result);

?>