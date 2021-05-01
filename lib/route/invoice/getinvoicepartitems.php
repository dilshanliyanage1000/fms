<?php
include_once("../../functions/invoice.php");

$result = getinvoicePartItemsbyID($_GET['id']);

echo($result);

?>