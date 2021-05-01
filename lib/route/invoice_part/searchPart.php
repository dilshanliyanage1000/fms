<?php
include_once("../../functions/invoice.php");

$result = partSearchInvoice($_GET['data']);

echo($result);

?>