<?php
include_once("../../functions/miscellaneous.php");

$result = addRMPART($_POST['pt_id'],$_POST['PartRMList']);

echo($result);

?>