<?php

include_once("../../functions/miscellaneous.php");

$result = getEachPartoRMonReq($_GET['partReqList']);

echo($result);

?>