<?php
//call the function
include_once("../../functions/attendance.php");

$result = markAttendance($_POST['data']);

echo($result);

?>