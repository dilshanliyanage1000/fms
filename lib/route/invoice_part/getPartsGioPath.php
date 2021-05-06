<?php
include_once("../../functions/invoice.php");

$result = getPartGIOPath($_GET['id']);

echo($result);

?>