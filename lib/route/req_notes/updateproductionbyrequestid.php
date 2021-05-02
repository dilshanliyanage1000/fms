<?php

include_once("../../functions/request_notes.php");

$result = updateProductionbyRQST($_POST['requestID'], $_POST['updation_date'], $_POST['logged_user']);

echo ($result);

?>