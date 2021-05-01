<?php

include_once("../../functions/quotation.php");

$result = getPartQuotation($_GET['id']);

echo($result);

?>