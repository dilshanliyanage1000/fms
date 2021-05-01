<?php
//call the function
include_once("../../functions/attendance.php");

$result = getWHours($_GET['id'], $_GET['monthyear']);

echo($result);

?>