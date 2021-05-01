<?php
//call the function
include_once("../../functions/quotation.php");

$result = prodSearchQuotation($_GET['data']);

echo($result);

?>