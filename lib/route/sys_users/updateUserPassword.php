<?php

include_once("../../functions/system_users.php");

$result = editPassword($_POST['userID'],$_POST['empID'],$_POST['passwordOne'],$_POST['passwordTwo']);

echo($result);
?>