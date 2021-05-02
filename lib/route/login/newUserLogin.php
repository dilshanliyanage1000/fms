<?php

include_once("../../functions/system_users.php");

$result = newUserLogin($_POST['empID'], $_POST['jobrole'], $_POST['password'], $_POST['passwordtwo']);

echo ($result);

?>