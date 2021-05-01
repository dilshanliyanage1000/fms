<?php
//call the function
include_once("../../functions/employee.php");

$result = verifyMail($_GET['data']);

echo($result);

?>