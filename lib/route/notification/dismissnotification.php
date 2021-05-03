<?php
//call the function
include_once("../../functions/notification.php");

$result = DismissNotification($_POST['id']);

echo($result);

?>