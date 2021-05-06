<?php

include_once('../../functions/system_users.php');

$result = deleteUser($_POST['id']);

echo ($result);

?>