<?php
//call the function
include_once("../../functions/sales.php");

$result = returnSales($_POST['invoiceCode']);

echo($result);

?>