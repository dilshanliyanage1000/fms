<?php
//include the customer function
include_once("../../functions/customer.php");

$result = editcustomer($_POST['cusID'],$_POST['cusFName'],$_POST['cusLName'],$_POST['cusEmail'],$_POST['cusPhoneOneCode'], 
                    $_POST['cusPhoneOne'],$_POST['cusPhoneTwoCode'],$_POST['cusPhoneTwo'],$_POST['cusHouseNo'], $_POST['cusStreetOne'],
                    $_POST['cusStreetTwo'],$_POST['cusCity'],$_POST['cusPCode']);

echo($result);
?>