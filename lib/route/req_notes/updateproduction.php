<?php

include_once("../../functions/request_notes.php");

$result = updateMachineProduction($_POST['production_update_requester'], $_POST['updation_date'], $_POST['logged_user'], $_POST['productionUpdateList']);

echo ($result);

?>