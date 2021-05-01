<?php
//call the function
include_once("../../functions/quotation.php");

$result = cusSearchQuotation($_GET['data']);

echo ($result);
?>