<?php

include_once('db_conn.php');

include_once('id_maker.php');

// check whether the given email exists in the database
function verifyMail($search)
{
    $conn = Connection();

    $searchSql = "SELECT * FROM emp_tbl WHERE emp_email = '$search';";

    $searchQuery = mysqli_query($conn, $searchSql);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($searchQuery);

    if ($nor > 0) {
        echo ("success");
    } else {
        echo ("No record found!");
    }
};

//register a new employee
function empRegistration($file_name, $file_path, $firstname, $lastname, $jobrole, $nic, $phone1, $phone2, $address, $email)
{
    //check empty parameters
    if (empty($jobrole) or empty($firstname) or empty($lastname) or empty($nic) or empty($phone1) or empty($address) or empty($email)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $id = Auto_id("emp_id", "emp_tbl", "EMP");

    //check whther the user has uploaded a profile imagge
    $employee_image = '';

    if ($file_name == '' || $file_path == '') {
    } else {
        $employee_image = $id . "-" . $file_name;

        move_uploaded_file($file_path, "../../images/employee/$employee_image");

        $employee_image = 'images/employee/' . $employee_image;
    }

    //insert a new employee into the database
    $sql_insert = "INSERT INTO emp_tbl (emp_id, emp_fname, emp_lname, jobrole_id, emp_nic, emp_telno, emp_telno_2, emp_address, emp_email, emp_img_path, emp_status)
                    VALUES ('$id','$firstname','$lastname','$jobrole','$nic','$phone1','$phone2','$address','$email','$employee_image',1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return ("success");
    } else {
        return ("Error, Try again !!");
    }
}

// view all the current employees
function ViewEmployee()
{
    $conn = Connection();

    //get all the current employees with their jobroles
    $view_sql = "SELECT *
                FROM emp_tbl
                INNER JOIN emp_jobrole_tbl
                ON emp_tbl.jobrole_id = emp_jobrole_tbl.jobrole_id
                WHERE emp_tbl.emp_status = 1
                ORDER BY emp_tbl.emp_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            if ($rec['emp_id'] == 'EMP0000001') {
                
            } else {

                echo ("<td>" . $rec['emp_id'] . "</td>");

                echo ("<td>
                        <img id='zoom' src='../../" . $rec['emp_img_path'] . "' alt='Employee Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px;'>
                    </td>");

                echo ("<td>" . $rec['emp_fname'] . "&nbsp;" . $rec['emp_lname'] . "</td>");

                //with different jobroles, output different colored badges
                if ($rec['jobrole_id'] == "EJR0000001") {
                    echo ("<td><span class='badge badge-pill badge-dark'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000002") {
                    echo ("<td><span class='badge badge-pill badge-primary'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000003") {
                    echo ("<td><span class='badge badge-pill badge-secondary'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000004") {
                    echo ("<td><span class='badge badge-pill badge-info'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000005") {
                    echo ("<td><span class='badge badge-pill badge-danger'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000006") {
                    echo ("<td><span class='badge badge-pill badge-warning'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000007") {
                    echo ("<td><span class='badge badge-pill badge-light'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000008") {
                    echo ("<td><span class='badge badge-pill badge-primary'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000009") {
                    echo ("<td><span class='badge badge-pill badge-secondary'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000010") {
                    echo ("<td><span class='badge badge-pill badge-info'>" . $rec['jobrole_name'] . "</span></td>");
                } else if ($rec['jobrole_id'] == "EJR0000011") {
                    echo ("<td><span class='badge badge-pill badge-danger'>" . $rec['jobrole_name'] . "</span></td>");
                } else {
                    echo ("<td><span class='badge badge-pill badge-dark'>" . $rec['jobrole_name'] . "</span></td>");
                }

                echo ("<td>" . $rec['emp_nic'] . "</td>");
                echo ("<td>" . $rec['emp_telno'] . "<br>" . $rec['emp_telno_2'] . "</td>");
                echo ("<td>" . $rec['emp_address'] . "</td>");
                echo ("<td>" . $rec['emp_email'] . "</td>");

                if ($rec['emp_status'] == 1) {
                    echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
                } else {
                    echo ("<td><span class='badge badge-pill badge-danger'>Removed</span></td>");
                }

                echo ("<td><button id=" . $rec['emp_id'] . " class='btn btn-info btn-sm'>QR</button></td>");
                echo ("<td><button id=" . $rec['emp_id'] . " class='btn btn-success btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
                echo ("<td><button id=" . $rec['emp_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");

                echo ("</tr>");
            }
        }
    } else {
        return (" No record found");
    }
}

//view all the deleted employees of the industry
function ViewDeletedEmployees()
{
    $conn = Connection();

    // get all the deleted employees with their jobroles
    $view_sql = "SELECT *
                FROM emp_tbl
                INNER JOIN emp_jobrole_tbl
                ON emp_tbl.jobrole_id = emp_jobrole_tbl.jobrole_id
                WHERE emp_tbl.emp_status = 0
                ORDER BY emp_tbl.emp_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['emp_id'] . "</td>");

            echo ("<td>
                        <img id='zoom' src='../../" . $rec['emp_img_path'] . "' alt='Employee Image' class='responsive' style='height:80px; width:80px; margin-left:1px; margin-bottom:1px; margin-top:1px; margin-right:1px;'>
                    </td>");

            echo ("<td>" . $rec['emp_fname'] . "&nbsp;" . $rec['emp_lname'] . "</td>");

            if ($rec['jobrole_id'] == "EJR0000001") {
                echo ("<td><span class='badge badge-pill badge-dark'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000002") {
                echo ("<td><span class='badge badge-pill badge-primary'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000003") {
                echo ("<td><span class='badge badge-pill badge-secondary'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000004") {
                echo ("<td><span class='badge badge-pill badge-info'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000005") {
                echo ("<td><span class='badge badge-pill badge-danger'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000006") {
                echo ("<td><span class='badge badge-pill badge-warning'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000007") {
                echo ("<td><span class='badge badge-pill badge-light'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000008") {
                echo ("<td><span class='badge badge-pill badge-primary'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000009") {
                echo ("<td><span class='badge badge-pill badge-secondary'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000010") {
                echo ("<td><span class='badge badge-pill badge-info'>" . $rec['jobrole_name'] . "</span></td>");
            } else if ($rec['jobrole_id'] == "EJR0000011") {
                echo ("<td><span class='badge badge-pill badge-danger'>" . $rec['jobrole_name'] . "</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-dark'>" . $rec['jobrole_name'] . "</span></td>");
            }

            echo ("<td>" . $rec['emp_nic'] . "</td>");
            echo ("<td>" . $rec['emp_telno'] . "<br>" . $rec['emp_telno_2'] . "</td>");
            echo ("<td>" . $rec['emp_address'] . "</td>");
            echo ("<td>" . $rec['emp_email'] . "</td>");

            if ($rec['emp_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Removed</span></td>");
            }

            echo ("<td><button id=" . $rec['emp_id'] . " class='btn btn-info btn-sm'>QR</button></td>");
            echo ("<td><button id=" . $rec['emp_id'] . " class='btn btn-secondary btn-reactivate btn-sm'><i class='fas fa-sync'></i>&nbsp;&nbsp;Reactivate</button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//get all the data of a single employee
function getsingleEmp($id)
{

    $conn = Connection();

    $sql_select = "SELECT *, emp_jobrole_tbl.jobrole_name
                    FROM emp_tbl
                    INNER JOIN emp_jobrole_tbl
                    ON emp_tbl.jobrole_id = emp_jobrole_tbl.jobrole_id
                    WHERE emp_tbl.emp_id='$id';";

    $sql_result = mysqli_query($conn, $sql_select);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {
        $rec = mysqli_fetch_assoc($sql_result);

        return json_encode($rec);
    } else {
        return false;
    }
};

//edit or update employee details
function editEmployee($file_name, $file_path, $id, $firstname, $lastname, $jobrole, $nic, $phone1, $phone2, $address, $email)
{
    //check whether the user has provided another profile image
    if (empty($file_name) || empty($file_path)) {

        $conn = Connection();

        $sql_update = "UPDATE emp_tbl SET emp_fname = '$firstname', emp_lname = '$lastname', jobrole_id = '$jobrole', emp_nic = '$nic',
                            emp_telno = '$phone1', emp_telno_2 = '$phone2', emp_address = '$address', emp_email = '$email' WHERE emp_id = '$id';";

        $update_result = mysqli_query($conn, $sql_update);

        //validate the command
        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($update_result > 0) {
            return ("success");
        } else {
            return false;
        }
    } else {

        $conn = Connection();

        $employee_image = $id . $file_name;

        move_uploaded_file($file_path, "../../images/employee/$employee_image");

        $sql_update = "UPDATE emp_tbl
                        SET emp_fname = '$firstname', emp_lname = '$lastname', jobrole_id = '$jobrole', emp_nic = '$nic', emp_telno = '$phone1', emp_telno_2 = '$phone2', emp_address = '$address',
                        emp_email = '$email', emp_img_path = '../../images/employee/$employee_image' WHERE emp_id = '$id';";

        $update_result = mysqli_query($conn, $sql_update);

        //validate the command
        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($update_result > 0) {
            return ("success");
        } else {
            return false;
        }
    }
}

function updateStatus($empID)
{
    $conn = Connection();

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //soft deleting an employee
    $sql_update = "UPDATE emp_tbl SET emp_status = 0 WHERE emp_id = '$empID';";

    $update_result = mysqli_query($conn, $sql_update);

    //if the user has a login, the login will be deactivated as well
    $checkUser = "SELECT * FROM user_tbl WHERE emp_id = '$empID';";

    $runCheck = mysqli_query($conn, $checkUser);

    $nor = mysqli_num_rows($runCheck);

    if ($nor > 1) {

        $user_update = "UPDATE user_tbl SET user_status = 0 WHERE emp_id = '$empID';";

        $update_user = mysqli_query($conn, $user_update);

        if ($update_result > 0 && $update_user > 0) {
            echo ("Deleted");
        } else {
            return false;
        }
    } else {

        if ($update_result > 0) {
            echo ("Deleted");
        } else {
            return false;
        }
    }
}

function reactivateEmployee($empID)
{
    $conn = Connection();

    $sql_update = "UPDATE emp_tbl SET emp_status = 1 WHERE emp_id = '$empID';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        echo ("restored");
    } else {
        return false;
    }
}

function getSupervisorsforRQST()
{
    $conn = Connection();

    //getting supervisors and managers for requests 
    $getSQL = "SELECT emp_tbl.emp_id, emp_tbl.emp_fname, emp_tbl.emp_lname, emp_tbl.emp_nic, emp_jobrole_tbl.jobrole_name
                FROM emp_tbl
                INNER JOIN emp_jobrole_tbl
                ON emp_tbl.jobrole_id = emp_jobrole_tbl.jobrole_id
                WHERE emp_jobrole_tbl.jobrole_name = 'Supervisor' OR emp_jobrole_tbl.jobrole_name = 'Administrator'
                AND emp_tbl.emp_status = 1;";

    $search_result = mysqli_query($conn, $getSQL);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        //if such results exists, then...
        echo ('<option value="">--Select Supervisor --</option>');

        while ($rec = mysqli_fetch_assoc($search_result)) {
            echo ("<option value=" . $rec['emp_id'] . ">" . $rec['emp_fname'] . "&nbsp;" . $rec['emp_lname'] . "</option>");
        }
    } else {
        echo ("No record found");
    }
}

function getEmpNamebyID($id)
{
    $conn = Connection();

    $getNotifCount = "SELECT emp_fname, emp_lname FROM emp_tbl WHERE emp_id = '$id';";

    $countnotif = mysqli_query($conn, $getNotifCount);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($countnotif) > 0) {

        $rec = mysqli_fetch_assoc($countnotif);

        $name = $rec["emp_fname"] . ' ' . $rec["emp_lname"];

        return ($name);
    } else {
        return false;
    }
};

function validateEmpPhone($empID, $phoneno)
{
    $conn = Connection();

    $sqlcheck = "SELECT * FROM emp_tbl WHERE emp_telno = '$phoneno' OR emp_telno_2 = '$phoneno';";

    $runCheck = mysqli_query($conn, $sqlcheck);

    $nor = mysqli_num_rows($runCheck);

    if ($nor > 0) {

        $rec = mysqli_fetch_assoc($runCheck);

        if ($empID == $rec['emp_id']) {
            echo ('proceed_to_add');
        } else {
            echo ('phone_number_exists');
        }
    } else {
        echo ('proceed_to_add');
    }
}

function validateNewEmpPhone($phoneno)
{
    $conn = Connection();

    $sqlcheck = "SELECT * FROM emp_tbl WHERE emp_telno = '$phoneno' OR emp_telno_2 = '$phoneno';";

    $runCheck = mysqli_query($conn, $sqlcheck);

    $nor = mysqli_num_rows($runCheck);

    if ($nor > 0) {
        echo ('already_exits');
    } else {
        echo ('proceed_to_add');
    }
}

function validateNIC($id, $nic)
{
    $nic_array = array();

    $conn = Connection();

    $sqlcheck = "SELECT * FROM emp_tbl;";

    $runCheck = mysqli_query($conn, $sqlcheck);

    $nor = mysqli_num_rows($runCheck);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($runCheck)) {
            array_push($nic_array, $rec['emp_nic']);
        }

        if (in_array($nic, $nic_array)) {
            echo ('nic_exists');
        } else {
            echo ("proceed");
        }
    } else {
        echo ('no_records');
    }
}
