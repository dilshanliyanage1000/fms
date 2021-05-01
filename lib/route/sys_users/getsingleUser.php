<?php
include_once("../../functions/system_users.php");

$result = getsingleUser($_GET['id']);

echo ($result);
?>