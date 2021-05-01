<?php
//call the function
include_once("../../functions/attendance.php");

$result = SearchEmp($_GET['data']);

echo($result);

?>