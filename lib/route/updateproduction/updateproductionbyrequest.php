<?php

include_once("../../functions/request_notes.php");

$result = validateProductionbyReq($_GET['value']);

echo ($result);

?>