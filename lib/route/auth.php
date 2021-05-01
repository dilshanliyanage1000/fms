<?php

include_once('../functions/auth.php');


$result = Auth($_POST['userEmail'],$_POST['pwd']);

echo($result);
?>