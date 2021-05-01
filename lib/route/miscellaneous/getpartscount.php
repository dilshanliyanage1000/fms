<?php

include_once("../../functions/miscellaneous.php");

$result = getPartsCount($_GET['id']);

echo($result);

?>