<?php
//call the function
include_once("../../functions/jobrole.php");

$result = createJobrole($_POST['jobrole_name'],$_POST['jobrole_basicsal'],$_POST['jobrole_maxsal']);

echo($result);

?>