<?php
include_once("../../functions/invoice.php");

$result = getPartInvoicePath($_GET['id']);

echo($result);

?>