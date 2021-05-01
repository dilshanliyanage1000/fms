<?php
//call the function
include_once("../../functions/auth.php");

$result = SearchUser($_GET['data']);

echo($result);

?>