<?php
//call the function
include_once("../../functions/quotation.php");

$result = getPartQuotation($_GET['id']);

echo($result);

?>