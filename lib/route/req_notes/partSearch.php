<?php

include_once("../../functions/request_notes.php");

$result = partSearchRQ($_GET['data']);

echo ($result);

?>