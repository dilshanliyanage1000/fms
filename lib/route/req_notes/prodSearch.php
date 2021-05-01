<?php
//call the function
include_once("../../functions/request_notes.php");

$result = prodSearchRQ($_GET['data']);

echo($result);

?>