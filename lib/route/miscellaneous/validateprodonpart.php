<?php
include_once("../../functions/miscellaneous.php");

$result = validateProduct($_GET['id']);

echo($result);

?>