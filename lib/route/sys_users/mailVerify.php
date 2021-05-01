<?php
//call the function
include_once("../../functions/system_users.php");

$result = verifyEmail($_GET['data']);

echo($result);

?>