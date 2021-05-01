<?php
//call the function
include_once("../../functions/supplier.php");

$result = regSupplier($_POST['name'],$_POST['phoneone'],$_POST['phonetwo'],$_POST['fax'],$_POST['address'],$_POST['email'],$_POST['supplier_rm']);

echo($result);

?>