<?php
//call the function
include_once("../../functions/request_notes.php");

$result = getRMSUP($_GET['id']);

echo($result);

?>