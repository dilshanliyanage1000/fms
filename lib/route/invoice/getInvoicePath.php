<?php
include_once("../../functions/invoice.php");

$result = getInvoicePath($_GET['id']);

echo($result);

?>