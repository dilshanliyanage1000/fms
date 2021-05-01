<?php
//call the function
include_once("../../functions/attendance.php");

$result = SalaryReportValidation($_GET['id'], $_GET['monthyear']);

echo($result);

?>