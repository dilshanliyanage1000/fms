<?php

include_once("../../functions/request_notes.php");

$result = saveRequest('PRODUCTION-REQUEST',$_POST['production_requester'], $_POST['request_date'], $_POST['logged_user'],$_POST['usersName'],$_POST['ProdReqList']);

echo($result);

?>