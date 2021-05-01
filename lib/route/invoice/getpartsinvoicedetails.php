<?php
//call the function
include_once("../../functions/invoice.php");

$result = getpartsinvoicebyID($_GET['id']);

echo($result);

?>