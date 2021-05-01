<?php
//call the function
include_once("../../functions/customer.php");

$result = customerReg($_POST['firstname'],$_POST['lastname'],$_POST['mail'],$_POST['code_phoneone'],
                            $_POST['phoneone'],$_POST['code_phonetwo'],$_POST['phonetwo'],$_POST['houseno'],
                            $_POST['street1'],$_POST['street2'],$_POST['city'],$_POST['pcode']);

echo($result);

?>