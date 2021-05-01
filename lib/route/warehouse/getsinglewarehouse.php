<?php

include_once("../../functions/warehouse.php");

$result = getsingleWarehouse($_GET['id']);

echo ($result);

?>