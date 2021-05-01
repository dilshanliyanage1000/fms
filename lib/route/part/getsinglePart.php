<?php
//include the function

include_once("../../functions/part.php");

$result = getsinglePart($_GET['id']);

echo ($result);
?>