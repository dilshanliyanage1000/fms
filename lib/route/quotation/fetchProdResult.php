<?php
//call the function
include_once("../../functions/quotation.php");

$result = getProdQuotation($_GET['id']);

echo($result);

?>