<?php
//call the function
include_once("../../functions/invoice.php");

$result = getProductStockQty($_GET['id']);

echo($result);

?>