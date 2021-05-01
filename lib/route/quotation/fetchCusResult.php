<?php
//call the function
include_once("../../functions/quotation.php");

$result = getCusQuotation($_GET['id']);

echo($result);

?>