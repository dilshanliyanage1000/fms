<?php

include_once('db_conn.php');

include_once('id_maker.php');

function getEmp($id)
{
    $conn = Connection();

    $getSQL = "SELECT *
                FROM ((emp_tbl
                INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id)
                INNER JOIN emp_jobrole_tbl ON emp_tbl.jobrole_id = emp_jobrole_tbl.jobrole_id)
                WHERE user_tbl.user_id = '$id';";

    $runSQL = mysqli_query($conn, $getSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor == 1) {

        $rec = mysqli_fetch_assoc($runSQL);

        echo (json_encode($rec));
    } else {
        return ("error");
    }
}

function validatePassword($id, $password)
{
    $conn = Connection();

    $validateSQL = "SELECT * FROM user_tbl WHERE user_id = '$id';";

    $runSQL = mysqli_query($conn, $validateSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor == 1) {
        $rec = mysqli_fetch_assoc($runSQL);

        $password = md5($password);

        if ($rec["user_pwd"] == $password) {
            echo ("success");
        } else {
            echo ("incorrect_password");
        }
    } else {
        return ("No records found!");
    }
}

function changePassword($id, $currentpw, $newpw, $retypenewpw)
{
    $conn = Connection();

    $checkSQL = "SELECT * FROM user_tbl WHERE user_id = '$id';";

    $runSQL = mysqli_query($conn, $checkSQL);

    $nor = mysqli_num_rows($runSQL);

    if ($nor == 1) {

        $rec = mysqli_fetch_assoc($runSQL);

        $currentpw = md5($currentpw);
        $newpw = md5($newpw);
        $retypenewpw = md5($retypenewpw);

        if ($rec["user_pwd"] == $currentpw) {

            if ($newpw == $retypenewpw) {

                $insertSQL = "UPDATE user_tbl SET user_pwd = '$newpw' WHERE user_id = '$id';";

                $runInsert = mysqli_query($conn, $insertSQL);

                if ($runInsert > 0) {
                    echo ('success');
                } else {
                    echo ('update_failed');
                }
            } else {
                echo ("unknown_changes");
            }
        } else {
            echo ("incorrect_password");
        }
    } else {
        return ("No records found!");
    }
}

function updateEmployee($id, $firstname, $lastname, $phone1, $phone2, $address)
{
    if (empty($id) or empty($firstname) or empty($lastname) or empty($phone1) or empty($phone2) or empty($address)) {
        return ('Please check your inputs...');
    }

    $conn = Connection();

    $sql_update = "UPDATE emp_tbl SET emp_fname = '$firstname', emp_lname = '$lastname', emp_telno = '$phone1', emp_telno_2 = '$phone2', emp_address = '$address'
                    WHERE emp_id = '$id';";

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


function getAttendanceDates($id)
{
    $attDates = array();

    $conn = Connection();

    $getDates = "SELECT DISTINCT(attendance_tbl.attendance_date) AS att_dates
                    FROM attendance_tbl
                    INNER JOIN user_tbl
                    ON attendance_tbl.emp_id = user_tbl.emp_id
                    WHERE user_tbl.user_id = '$id';";

    $runQuery = mysqli_query($conn, $getDates);

    $nor = mysqli_num_rows($runQuery);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($runQuery)) {

            $d = strtotime($rec['att_dates']);
            
            $dates = date('m-d-Y', $d);

            array_push($attDates, $dates);
        }

        echo (json_encode($attDates));
    } else {
        return ("no records found");
    }
}
