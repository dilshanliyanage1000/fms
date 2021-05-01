<?php

include_once("../../functions/attendance.php");

if ($_POST['empOTHours'] == '' || ['empOTSalary'] == '' || $_POST['FinalOTSal'] == '') {
    $result = addtoSalaryReport(
        $_POST['employeeID'],
        $_POST['monthandyear'],
        $_POST['empTotWorkhours'],
        $_POST['empWorkHours'],
        $_POST['empCurrentSal'],
        NULL,
        NULL,
        $_POST['FinalWorkSal'],
        NULL,
        $_POST['FinalSalarySum']
    );

    echo ($result);
} else {
    $result = addtoSalaryReport(
        $_POST['employeeID'],
        $_POST['monthandyear'],
        $_POST['empTotWorkhours'],
        $_POST['empWorkHours'],
        $_POST['empCurrentSal'],
        $_POST['empOTHours'],
        $_POST['empOTSalary'],
        $_POST['FinalWorkSal'],
        $_POST['FinalOTSal'],
        $_POST['FinalSalarySum']
    );

    echo ($result);
}

?>