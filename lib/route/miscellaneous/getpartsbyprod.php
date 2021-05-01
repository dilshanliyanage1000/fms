<?php

include_once("../../functions/miscellaneous.php");

$result = getPartsbyProd($_GET['data']);

echo($result);

?>