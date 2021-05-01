<?php

include_once("../../functions/miscellaneous.php");

$result = getEachProdtoPartReq($_GET['prodReqList']);

echo($result);

?>