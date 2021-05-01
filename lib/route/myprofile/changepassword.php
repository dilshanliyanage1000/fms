<?php
//call the function
include_once("../../functions/myprofile.php");

$result = changePassword($_POST['userID'], $_POST['currentpassword'], $_POST['newpassword'], $_POST['retypenewpassword']);

echo ($result);
?>