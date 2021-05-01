<?php
// import the databse connection
include_once('db_conn.php');

// id auto genarator
include_once('id_maker.php');

date_default_timezone_set('Asia/Colombo');


function SearchEmp($search)
{
    // call the connection
    $conn = Connection();

    $searchSql = "SELECT *
                    FROM emp_tbl
                    WHERE emp_id LIKE '%$search%' OR
                    emp_fname LIKE '%$search%' OR
                    emp_lname LIKE '%$search%' OR
                    emp_nic LIKE '%$search%';";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }


    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {

        $output = '
            <table class="table table-hover table-striped table-inverse table-responsive" width="100%">
            <tr>
                <th class="th-sm">Employee ID</th>
                <th class="th-sm">First Name</th>
                <th class="th-sm">Last Name</th>
                <th class="th-sm">NIC</th>
                <th class="th-sm">Confirm</th>
            </tr>
        ';

        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            $output .= '
                <tr>
                <td id=' . $rec['emp_id'] . '>' . $rec['emp_id'] . '</td>
                <td id=' . $rec['emp_fname'] . '>' . $rec['emp_fname'] . '</td>
                <td id=' . $rec['emp_lname'] . '>' . $rec['emp_lname'] . '</td>
                <td name=' . $rec['emp_nic'] . '>' . $rec['emp_nic'] . '</td>
                <td> <button onclick="return false" class="btn btn-success" id=' . $rec['emp_id'] . '>Confirm</td>
                </tr>
                ';
        }

        echo ($output);
    } else {
        echo ("No record found!");
    }
}

function EmpData($empId)
{
    // call the connection
    $conn = Connection();

    $selectEmp = "SELECT * FROM emp_tbl WHERE emp_id = '$empId';";

    $empResult = mysqli_query($conn, $selectEmp);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($empResult);

    return (json_encode($rec));
}

function markAttendance($id)
{
    // call the connection
    $conn = Connection();

    //CREATE ID
    $auto_id = Auto_id('attendance_id', 'attendance_tbl', 'ATT');
    $today = date("Y-m-d");

    // attendance sql
    $filterStatus = "SELECT * FROM attendance_tbl WHERE emp_id = '$id' ORDER BY attendance_timestamp_one DESC LIMIT 1;";

    $search_result = mysqli_query($conn, $filterStatus);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    $updateAttendance = 0;
    $search_res = 0;


    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($search_result)) {
            if ($rec['attendance_status'] == 1) {

                $payroll_id = Auto_id('payroll_id', 'emp_payroll_tbl', 'PAY');

                $updateAttendance = "UPDATE attendance_tbl
                                        SET attendance_status = 0,
                                        attendance_timestamp_two = CURRENT_TIMESTAMP
                                        WHERE emp_id = '$id'
                                        ORDER BY attendance_timestamp_one DESC
                                        LIMIT 1;";

                $search_res = mysqli_query($conn, $updateAttendance);

                $calHoursSql = "SELECT TIMESTAMPDIFF(MINUTE, attendance_timestamp_one, attendance_timestamp_two) AS timediff, attendance_id
                                    FROM attendance_tbl
                                    WHERE emp_id='$id' AND attendance_date = '$today'
                                    ORDER BY emp_id DESC
                                    LIMIT 1;";

                $payrollHours = mysqli_query($conn, $calHoursSql);

                $record = mysqli_fetch_assoc($payrollHours);

                $mins = $record['timediff'];

                $attid = $record['attendance_id'];

                $addPayroll = "INSERT INTO emp_payroll_tbl(payroll_id, emp_id, attendance_id, attendance_date, tot_work_mins, payroll_status)
                                VALUES ('$payroll_id','$id','$attid','$today','$mins',1)";

                $insert_res = mysqli_query($conn, $addPayroll);

                if ($insert_res > 0) {
                    return ("loggedout");
                } else {
                    return false;
                }
            } else {

                $updateAttendance = "INSERT INTO attendance_tbl(attendance_id,emp_id,attendance_date,attendance_status)
                                        VALUES ('$auto_id','$id','$today',1);";

                $search_res = mysqli_query($conn, $updateAttendance);

                if ($search_res > 0) {
                    return ("success");
                } else {
                    return false;
                }
            }
        }
    } else {

        $updateAttendance = "INSERT INTO attendance_tbl(attendance_id,emp_id,attendance_date,attendance_status)
                                VALUES ('$auto_id','$id','$today',1);";

        $search_res = mysqli_query($conn, $updateAttendance);

        if ($search_res > 0) {
            return ("success");
        } else {
            return false;
        }
    }
};

function getWHours($empId, $monthyear)
{
    $month_w_year = explode("-", $monthyear);

    $startdate = $month_w_year[1] . '-' . $month_w_year[0] . '-01';

    $enddate = $month_w_year[1] . '-' . $month_w_year[0] . '-31';

    $conn = Connection();

    $getWH = "SELECT emp_tbl.emp_id, emp_jobrole_tbl.jobrole_name, emp_jobrole_tbl.jobrole_basicsal, emp_jobrole_tbl.jobrole_maxsal, SUM(emp_payroll_tbl.tot_work_mins) AS tot_hrs
                FROM ((emp_tbl
                INNER JOIN emp_payroll_tbl ON emp_tbl.emp_id = emp_payroll_tbl.emp_id)
                INNER JOIN emp_jobrole_tbl ON emp_tbl.jobrole_id = emp_jobrole_tbl.jobrole_id)
                WHERE emp_tbl.emp_id = '$empId'AND emp_payroll_tbl.attendance_date BETWEEN '$startdate' AND '$enddate';";

    $empResult = mysqli_query($conn, $getWH);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $rec = mysqli_fetch_assoc($empResult);

    return (json_encode($rec));
};

function addtoSalaryReport($employeeID, $monthandyear, $empTotWorkhours, $empWorkHours, $empCurrentSal, $empOTHours, $empOTSalary, $FinalWorkSal, $FinalOTSal, $FinalSalarySum)
{
    if (empty($employeeID) or empty($monthandyear) or empty($empTotWorkhours) or empty($empWorkHours) or empty($empCurrentSal) or empty($empOTHours) or empty($empOTSalary) or empty($FinalWorkSal) or empty($FinalOTSal) or empty($FinalSalarySum)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $bstring = explode("-", $monthandyear);

    $propermonth = $bstring[1] . '-' . $bstring[0];

    $id = Auto_id("sal_id", "emp_salary_tbl", "ESL");

    $insertSQL = "INSERT INTO emp_salary_tbl(sal_id,emp_id,sal_month,sal_totwork_hrs,sal_work_hrs,sal_current_sal,sal_otwork_hrs,sal_ot_sal,sal_currentpay,sal_otpay,sal_totmonthsal,sal_status)
                    VALUES('$id', '$employeeID', '$propermonth', '$empTotWorkhours', '$empWorkHours', '$empCurrentSal', '$empOTHours', '$empOTSalary', '$FinalWorkSal', '$FinalOTSal', '$FinalSalarySum',1);";

    $runSQL = mysqli_query($conn, $insertSQL);

    if ($runSQL > 0) {
        return ($id);
    } else {
        return ('error!');
    }
}

function addSalaryPDF($id, $path)
{
    $conn = Connection();

    $insertSQL = "UPDATE emp_salary_tbl SET sal_report_pdf = '$path' WHERE sal_id = '$id';";

    $runSQL = mysqli_query($conn, $insertSQL);

    if ($runSQL > 0) {
        return ($id);
    } else {
        return ('error!');
    }
}

function SalarySheets()
{
    // call the connection
    $conn = Connection();

    $searchSql = "SELECT emp_salary_tbl.sal_id, emp_tbl.emp_fname, emp_tbl.emp_lname, emp_tbl.emp_nic, emp_salary_tbl.sal_month, emp_salary_tbl.sal_totmonthsal, emp_salary_tbl.sal_report_pdf, emp_salary_tbl.sal_create_time
                    FROM emp_salary_tbl
                    INNER JOIN emp_tbl
                    ON emp_salary_tbl.emp_id = emp_tbl.emp_id;";

    $searchQuery = mysqli_query($conn, $searchSql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($searchQuery)) {
            echo ("<td style='text-align:center;'>" . $rec['sal_id'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['sal_month'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['emp_fname'] . "&nbsp;" . $rec['emp_lname'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['emp_nic'] . "</td>");
            echo ("<td style='text-align:center;'>Rs. " . number_format($rec['sal_totmonthsal']) . ".00</td>");
            echo ("<td style='text-align:center;'><a href='" . $rec['sal_report_pdf'] . "' target='_blank'><button class='btn btn-info'><i class='fas fa-file-signature'></i>&nbsp;&nbsp;View Salary Sheet</button></a></td>");
            echo ("<td style='text-align:center;'>" . $rec['sal_create_time'] . "</td>");
        }
    } else {
        echo ("No record found!");
    }
}

function SalaryReportValidation($id, $monthdate)
{
    $conn = Connection();

    $monthdate = explode("-", $monthdate);

    $sendDate = $monthdate[1] . '-' . $monthdate[0];

    $searchSQL = "SELECT * FROM emp_salary_tbl WHERE emp_id = '$id' AND sal_month = '$sendDate';";

    $runSQL = mysqli_query($conn, $searchSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor > 0) {
        return ('error');
    } else {
        return ('create');
    }
}

?>