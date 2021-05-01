<?php
//call the function
include_once("../../functions/employee.php");

$result = validateEmpPhone($_GET['id'], $_GET['phone']);

echo ($result);

?>