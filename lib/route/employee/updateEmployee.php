<?php

include_once("../../functions/employee.php");

$file_path = $_FILES['edit_employee_image']['tmp_name'];

$allowed = array('gif', 'png', 'jpg', 'jpeg');

$file_name = $_FILES['edit_employee_image']['name'];

$ext = pathinfo($file_name, PATHINFO_EXTENSION);

if (empty($file_path) || empty($file_name)) {

    $result = editEmployee(
        $file_name,
        $file_path,
        $_POST['emp_id'],
        $_POST['emp_fname'],
        $_POST['emp_lname'],
        $_POST["emp_jobrole"],
        $_POST['emp_nic'],
        $_POST['emp_telno'],
        $_POST['emp_telno_2'],
        $_POST['emp_address'],
        $_POST['emp_email']
    );

    echo ($result);
} else {

    if (!in_array($ext, $allowed)) {
        echo ("ext_error");
    } else {

        $result = editEmployee(
            $file_name,
            $file_path,
            $_POST['emp_id'],
            $_POST['emp_fname'],
            $_POST['emp_lname'],
            $_POST["emp_jobrole"],
            $_POST['emp_nic'],
            $_POST['emp_telno'],
            $_POST['emp_telno_2'],
            $_POST['emp_address'],
            $_POST['emp_email']
        );

        echo ($result);
    }
}

?>