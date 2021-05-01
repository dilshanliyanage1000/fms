<?php
include_once("../../functions/invoice.php");

$result = prodSearchInvoice($_GET['data']);

echo($result);

?>