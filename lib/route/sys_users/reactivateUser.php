<?php

include_once('../../functions/system_users.php');

$result = reactivateUser($_POST['id']);

echo ($result);

?>