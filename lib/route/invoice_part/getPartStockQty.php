<?php
//call the function
include_once("../../functions/invoice.php");

$result = getPartStockQty($_GET['id']);

echo($result);

?>