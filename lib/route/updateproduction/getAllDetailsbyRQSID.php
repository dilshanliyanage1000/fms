<?php

include_once("../../functions/request_notes.php");

$result = getRQSTdetailsbyID($_GET['id']);

echo ($result);

?>