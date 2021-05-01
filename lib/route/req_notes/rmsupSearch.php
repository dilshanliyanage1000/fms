<?php

include_once("../../functions/request_notes.php");

$result = getRMRQST($_GET['data']);

echo($result);

?>