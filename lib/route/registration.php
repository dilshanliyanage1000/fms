<?php

include_once('../functions/registration.php');


$result = Registration($_POST['u_name'],$_POST['u_mail'],$_POST['u_pwd'],$_POST['u_role']);

echo($result);
?>