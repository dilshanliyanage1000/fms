<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');


function registerWarehouse($location, $address, $phoneone, $phonetwo, $description)
{

    //validation
    if (empty($location) or empty($address) or empty($phoneone) or empty($description)) {
        return ("Please check your inputs ... ");
    }

    //call the connection
    $conn = Connection();

    //call the Auto_id function
    $id = Auto_id("wh_id", "warehouse_tbl", "WRH");

    //if optional phone number is not included - run this query
    if (empty($phonetwo)) {
        //insert data into warehouse table 

        $sql_insert = "INSERT INTO warehouse_tbl (wh_id, wh_location, wh_address, wh_phone_one, wh_description, wh_status)
                        VALUES ('$id','$location','$address','$phoneone','$description',1);";
    } else {
        //insert data into warehouse table 

        $sql_insert = "INSERT INTO warehouse_tbl (wh_id, wh_location, wh_address, wh_phone_one, wh_phone_two, wh_description, wh_status)
                        VALUES ('$id','$location','$address','$phoneone','$phonetwo','$description',1);";
    }

    $sql_result = mysqli_query($conn, $sql_insert);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return "Success";
    } else {
        return "Error, Try again !!";
    }
}


//view warehouse details 
function ViewWarehouse()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM warehouse_tbl ORDER BY wh_id DESC ;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {
            echo ("<td>" . $rec['wh_id'] . "</td>");
            echo ("<td>" . $rec['wh_location'] . "</td>");
            echo ("<td>" . $rec['wh_address'] . "</td>");
            echo ("<td>" . $rec['wh_phone_one'] . "</td>");
            echo ("<td>" . $rec['wh_phone_two'] . "</td>");
            echo ("<td>" . $rec['wh_description'] . "</td>");

            if ($rec['wh_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['wh_id'] . " class='btn btn-success btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td style='text-align:center;'><button id=" . $rec['wh_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        echo (" No record found");
    }
}

//edit warehouse details
function editWarehouse($id, $location, $address, $phoneone, $phonetwo, $description)
{

    $conn = Connection();

    //if optional phone number is empty - run this query
    if (empty($phonetwo)) {
        $sql_update = "UPDATE warehouse_tbl SET wh_location = '$location', wh_address = '$address', wh_phone_one = '$phoneone', wh_phone_one = '$phoneone', 
                        wh_description = '$description' WHERE wh_id = '$id';";

        $update_result = mysqli_query($conn, $sql_update);
    } else {
        $sql_update = "UPDATE warehouse_tbl SET wh_location = '$location', wh_address = '$address', wh_phone_one = '$phoneone', wh_phone_one = '$phoneone',
                        wh_phone_two = '$phonetwo', wh_description = '$description' WHERE wh_id = '$id';";

        $update_result = mysqli_query($conn, $sql_update);
    }

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

//update the warehouse status from 1 to 0
function updateStatus($whId)
{

    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE warehouse_tbl SET wh_status = 0 WHERE wh_id = '$whId';";

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

function getsingleWarehouse($id)
{

    $conn = Connection();

    $sql_select = "SELECT * FROM warehouse_tbl WHERE wh_id='$id';";
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

function getWarehouse()
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * FROM warehouse_tbl;";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            // select HTML view
            echo ("<option value=" . $rec['wh_id'] . ">" . $rec['wh_address'] . "</option>");
        }
    } else {
        echo ("No record found");
    }
}


//search section for warehouse
function whSearch($searchData)
{

    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * FROM warehouse_tbl 
                    WHERE wh_location LIKE '%$searchData%' OR 
                    wh_address LIKE '%$searchData%' OR 
                    wh_phone_one LIKE '%$searchData%' OR
                    wh_phone_two LIKE '%$searchData%' OR
                    wh_description LIKE '%$searchData%'
                    ORDER BY wh_id DESC;";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {
            if ($rec['wh_status'] == 0) {
                echo ("<tr id=tr_" . $rec['wh_id'] . " style='background-color: #fff0cf;'>");
            } else {
                echo ("<tr id=tr_" . $rec['wh_id'] . " style='background-color: #ffffff'>");
            }

            echo ("<td>" . $rec['wh_id'] . "</td>");
            echo ("<td>" . $rec['wh_location'] . "</td>");
            echo ("<td>" . $rec['wh_address'] . "</td>");
            echo ("<td>" . $rec['wh_phone_one'] . "</td>");
            echo ("<td>" . $rec['wh_phone_two'] . "</td>");
            echo ("<td>" . $rec['wh_description'] . "</td>");

            if ($rec['wh_status'] == 1) {
                echo ("<td><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td id=" . $rec['wh_id'] . " class='btn btn-success btn-default' style='margin-top:10px;margin-right:10px; margin-left:10px;' data-toggle='modal' data-target='#editModal'><i class='fas fa-user-edit'></i></td>");
            echo ("<td id=" . $rec['wh_id'] . " class='btn btn-warning btn-default' style='margin-left:10px;margin-bottom:10px;margin-top:10px;margin-right:10px'><i class='far fa-trash-alt'></i></td>");
            echo ("</tr>");
        }
    } else {
        echo (" No record found");
    }
}
