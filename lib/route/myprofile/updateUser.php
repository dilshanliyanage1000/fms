<?php

include_once("../../functions/myprofile.php");

$result = updateEmployee(
    $_POST['emp_id'],
    $_POST['emp_fname'],
    $_POST['emp_lname'],
    $_POST['emp_telno'],
    $_POST['emp_telno_2'],
    $_POST['emp_address'],
);

echo ($result);
