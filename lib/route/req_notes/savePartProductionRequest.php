<?php

include_once("../../functions/request_notes.php");

$result = saveRequest('PART-PRODUCTION-REQUEST',$_POST['production_requester'], $_POST['request_date'], $_POST['logged_user'],$_POST['usersName'],$_POST['PartReqTbl']);

echo($result);

?>