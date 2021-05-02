<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');

function createJobrole($jobrolename, $basicsal, $maxsal)
{
    //validation
    if (empty($jobrolename) or empty($basicsal) or empty($maxsal)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $id = Auto_id('jobrole_id', 'emp_jobrole_tbl', 'EJR');

    $insertSQL = "INSERT INTO emp_jobrole_tbl
                    VALUES ('$id ','$jobrolename','$basicsal','$maxsal',1)";

    $insert_res = mysqli_query($conn, $insertSQL);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($insert_res > 0) {
        return "success";
    } else {
        return "Error, Try again !!";
    }
}

function allJobroles()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM emp_jobrole_tbl WHERE jobrole_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['jobrole_id'] . "</td>");
            echo ("<td>" . $rec['jobrole_name'] . "</td>");
            echo ("<td>Rs. " . $rec['jobrole_basicsal'] . "</td>");
            echo ("<td>Rs. " . $rec['jobrole_maxsal'] . "</td>");
            if ($rec['jobrole_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }
            echo ("<td><button id=" . $rec['jobrole_id'] . " class='btn btn-primary' data-toggle='modal' data-target='#editModal'><i class='far fa-edit'></i></button></td>");
            echo ("<td><button id=" . $rec['jobrole_id'] . " class='btn btn-danger'><i class='fas fa-trash'></i></button></td>");

            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function deletedJobroles()
{
    $conn = Connection();

    $view_sql = "SELECT * FROM emp_jobrole_tbl WHERE jobrole_status = 0;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['jobrole_id'] . "</td>");
            echo ("<td>" . $rec['jobrole_name'] . "</td>");
            echo ("<td>Rs. " . $rec['jobrole_basicsal'] . "</td>");
            echo ("<td>Rs. " . $rec['jobrole_maxsal'] . "</td>");
            if ($rec['jobrole_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td><button id=" . $rec['jobrole_id'] . " class='btn btn-secondary btn-reactivate'><i class='fas fa-sync'></i></button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function getJobroleSelect()
{
    $conn = Connection();

    $sqlget = "SELECT * FROM emp_jobrole_tbl";

    $sql_result = mysqli_query($conn, $sqlget);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($sql_result)) {
            echo ("<option value=" . $rec['jobrole_id'] . ">" . $rec['jobrole_name'] . "</option>");
        }
    } else {
        return (" No record found");
    }
}

function getsingleJobrole($id)
{

    $conn = Connection();

    $sql_select = "SELECT * FROM emp_jobrole_tbl WHERE jobrole_id='$id';";
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
}

function editJobrole($id, $name, $basicsal, $maxsal)
{
    //validation
    if (empty($name) or empty($basicsal) or empty($maxsal)) {
        return ("Please check your inputs ... ");
    }

    $conn = Connection();

    $sql_update = "UPDATE emp_jobrole_tbl SET jobrole_name = '$name', jobrole_basicsal = '$basicsal', jobrole_maxsal = '$maxsal' WHERE jobrole_id = '$id';";


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

function deleteJobrole($jbrID)
{

    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE emp_jobrole_tbl SET jobrole_status = 0 WHERE jobrole_id = '$jbrID';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("Deleted");
    } else {
        return false;
    }
}

function reactivateJobrole($jbrID)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE emp_jobrole_tbl SET jobrole_status = 1 WHERE jobrole_id = '$jbrID';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("Deleted");
    } else {
        return false;
    }
}

?>