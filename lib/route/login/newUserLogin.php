<?php
//call the function
include_once("../../functions/system_users.php");

$result = newUserLogin($_POST['emp_id'],$_POST['f_name'],$_POST['l_name'],$_POST['email'],$_POST['role'],$_POST['password']);

echo($result);

?>