<?php
//call the function
include_once("../functions/customer.php");

$result = verifyMail($_GET['data']);

echo($result);

?>