<?php
include_once("../../functions/miscellaneous.php");

$result = addPartProd($_POST['id'],$_POST['PartProductList']);

echo($result);

?>