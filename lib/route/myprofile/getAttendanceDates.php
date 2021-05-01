<?php

include_once("../../functions/myprofile.php");

$result = getAttendanceDates($_GET['id']);

echo ($result);
?>