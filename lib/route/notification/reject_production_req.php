<?php

include_once("../../functions/notification.php");

$result = ConfirmRMReq($_POST['id'],'Declined');

echo($result);

?>