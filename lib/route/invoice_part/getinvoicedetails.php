<?php
//call the function
include_once("../../functions/invoice.php");

$result = getinvoicebyID($_GET['id']);

echo($result);

?>