<?php

include_once("../../functions/miscellaneous.php");

$result = getRequestDetails($_GET['id']);

echo($result);

?>