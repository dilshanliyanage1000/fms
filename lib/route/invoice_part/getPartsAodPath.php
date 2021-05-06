<?php
include_once("../../functions/invoice.php");

$result = getPartAODPath($_GET['id']);

echo($result);

?>