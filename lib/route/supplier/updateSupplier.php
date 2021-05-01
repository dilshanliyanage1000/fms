<?php
//include the supplier function

include_once("../../functions/supplier.php");

$result = editSupplier($_POST['supID'], $_POST['supName'], $_POST['supPhone'], $_POST['supPhoneTwo'], $_POST['supFax'], $_POST['supAddress'], $_POST['supEmail'], NULL);

echo ($result);
?>