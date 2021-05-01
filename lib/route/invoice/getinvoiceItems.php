<?php
include_once("../../functions/invoice.php");

$result = getinvoiceItemsbyID($_GET['id']);

echo($result);

?>