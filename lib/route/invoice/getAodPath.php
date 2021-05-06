<?php
include_once("../../functions/invoice.php");

$result = getAODPath($_GET['id']);

echo($result);

?>