<?php
include_once("../../functions/invoice.php");

$result = getGIOPath($_GET['id']);

echo($result);

?>