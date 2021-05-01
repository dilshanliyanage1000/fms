<?php

include_once("../../functions/myprofile.php");

$result = getEmp($_GET['id']);

echo ($result);
?>