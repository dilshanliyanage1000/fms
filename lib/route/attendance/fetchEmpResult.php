<?php
//call the function
include_once("../../functions/attendance.php");

$result = EmpData($_GET['id']);

echo($result);

?>