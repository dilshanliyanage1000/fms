<?php
//call the function
include_once("../../functions/myprofile.php");

$result = validatePassword($_GET['id'], $_GET['password']);

echo ($result);
?>