<?php

include_once("../../functions/employee.php");

$file_path = $_FILES['employee_image']['tmp_name'];

$allowed = array('gif', 'png', 'jpg', 'jpeg');

$file_name = $_FILES['employee_image']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if ($file_path == '') {
    $result = empRegistration(NULL, NULL, $_POST['first_name'], $_POST['last_name'], $_POST["job_role"], $_POST['nic'], $_POST['phone_1'], $_POST['phone_2'], $_POST['address'], $_POST['email']);
    echo ($result);
} else {
    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {
        $result = empRegistration($file_name, $file_path, $_POST['first_name'], $_POST['last_name'], $_POST["job_role"], $_POST['nic'], $_POST['phone_1'], $_POST['phone_2'], $_POST['address'], $_POST['email']);
        echo ($result);
    }
}
?>