<?php

//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');

function newUserLogin($emp_id, $role, $password, $passwordtwo)
{
    //validation
    if (empty($emp_id) or empty($role) or empty($password) or empty($passwordtwo)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $user_validation = "SELECT *
                        FROM emp_tbl
                        INNER JOIN user_tbl
                        ON emp_tbl.emp_id = user_tbl.emp_id
                        WHERE emp_tbl.emp_id = '$emp_id';";

    $search_result = mysqli_query($conn, $user_validation);

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {
        $error_msg = "This user already exists and has a login!";
        echo ($error_msg);
    } else {

        if ($password == $passwordtwo) {

            $id = Auto_id("user_id", "user_tbl", "USR");

            $newPwd = md5($password);

            $sql_insert = "INSERT INTO user_tbl (user_id, emp_id, user_pwd, user_role, user_status)
                            VALUES ('$id','$emp_id','$newPwd','$role',1);";

            $sql_result = mysqli_query($conn, $sql_insert);

            if ($sql_result > 0) {
                echo "success";
            } else {
                return "Error, Try again !!";
            }
        } else {

            return "Error, Try again !!";
        }
    }
}

function verifyEmail($search)
{
    // call the connection
    $conn = Connection();

    $searchSql = "SELECT * FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id WHERE emp_tbl.emp_email LIKE '%$search%';";

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

function getUsers()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            if ($rec['user_id'] == 'USR0000001') {
            } else {

                echo ("<td>" . $rec['user_id'] . "</td>");
                echo ("<td>" . $rec['emp_id'] . "</td>");
                echo ("<td>" . $rec['emp_fname'] . "</td>");
                echo ("<td>" . $rec['emp_lname'] . "</td>");
                echo ("<td>" . $rec['emp_email'] . "</td>");

                if ($rec['user_role'] == "1") {
                    echo ("<td style='text-align:center';><span class='badge badge-pill badge-dark'>Administrator</span></td>");
                } else if ($rec['user_role'] == "2") {
                    echo ("<td style='text-align:center';><span class='badge badge-pill badge-primary'>Manager</span></td>");
                } else if ($rec['user_role'] == "3") {
                    echo ("<td style='text-align:center';><span class='badge badge-pill badge-secondary'>Supervisor</span></td>");
                } else {
                    echo ("<td style='text-align:center';><span class='badge badge-pill badge-info'>In-office Employee</span></td>");
                }

                if ($rec['user_status'] == 1) {
                    echo ("<td style='text-align:center';><span class='badge badge-pill badge-primary'>Active</span></td>");
                } else {
                    echo ("<td style='text-align:center';><span class='badge badge-pill badge-danger'>Deactived</span></td>");
                }
                echo ("<td><button id=" . $rec['user_id'] . " class='btn btn-success btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
                echo ("<td><button id=" . $rec['user_id'] . " class='btn btn-danger btn-deluser btn-sm'>Delete</button></td>");

                echo ("</tr>");
            }
        }
    } else {
        return (" No record found");
    }
}

function getUserNamebyID($id)
{
    $conn = Connection();

    $usernameSQL = "SELECT emp_tbl.emp_fname, emp_tbl.emp_lname FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id WHERE user_tbl.user_id LIKE '%$id%';";

    $countnotif = mysqli_query($conn, $usernameSQL);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if (mysqli_num_rows($countnotif) > 0) {

        $rec = mysqli_fetch_assoc($countnotif);

        $name = $rec["emp_fname"] . '&nbsp;' . $rec["emp_lname"];

        return ($name);
    } else {
        return false;
    }
};

function getsingleUser($id)
{
    $conn = Connection();

    $usernameSQL = "SELECT * FROM emp_tbl INNER JOIN user_tbl ON emp_tbl.emp_id = user_tbl.emp_id WHERE user_tbl.user_id = '$id';";

    $sql_result = mysqli_query($conn, $usernameSQL);

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

function editPassword($userID, $empID, $passwordone, $passwordtwo)
{
    if (empty($userID) or empty($empID) or empty($passwordone) or empty($passwordtwo)) {
        return ("Please check your inputs ... ");
    }

    if ($passwordone == $passwordtwo) {

        $newPwd = md5($passwordone);

        $conn = Connection();

        $sql_update = "UPDATE user_tbl SET user_pwd = '$newPwd' WHERE user_id = '$userID' && emp_id = '$empID';";

        $update_result = mysqli_query($conn, $sql_update);

        if (mysqli_errno($conn)) {
            echo (mysqli_error($conn));
        }

        if ($update_result > 0) {
            return ("success");
        } else {
            return false;
        }
    } else {

        return false;
    }
}

function deleteUser($id)
{
    $conn = Connection();

    $deleteSQL = "UPDATE user_tbl SET user_status = 0 WHERE user_id = '$id';";

    $runSQL = mysqli_query($conn, $deleteSQL);

    if ($runSQL > 0) {
        echo ("success");
    } else {
        return false;
    }
}

function reactivateUser($id)
{
    $conn = Connection();

    $deleteSQL = "UPDATE user_tbl SET user_status = 1 WHERE user_id = '$id';";

    $runSQL = mysqli_query($conn, $deleteSQL);

    if ($runSQL > 0) {
        echo ("success");
    } else {
        return false;
    }
}

?>