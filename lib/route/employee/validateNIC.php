
<?php
//call the function
include_once("../../functions/employee.php");

$result = validateNIC($_GET['id'], $_GET['value']);

echo ($result);

?>