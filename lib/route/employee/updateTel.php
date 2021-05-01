<?php
//call the function
include_once("../../functions/employee.php");

$result = validateNewEmpPhone( $_GET['data']);

echo ($result);

?>