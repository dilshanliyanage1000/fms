<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');


function rawmatRegistration($name, $reorder, $desc)
{
    //validation
    if (empty($name) or empty($reorder)) {
        return ("Please check your inputs ... ");
    }

    //call the connection
    $conn = Connection();

    //call the Auto_id function
    $id = Auto_id("rm_id", "rawmaterial_tbl", "RMT");

    //insert data into raw materials table 

    $sql_insert = "INSERT INTO rawmaterial_tbl (rm_id, rm_name, rm_description, rm_reorder_level, rm_status)
                       VALUES ('$id','$name','$desc','$reorder', 1);";

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


//view Raw material details

function ViewRawMaterial()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM rawmaterial_tbl ORDER BY rm_id DESC;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td style='text-align:center;'>" . $rec['rm_id'] . "</td>");
            echo ("<td>" . $rec['rm_name'] . "</td>");
            echo ("<td>" . $rec['rm_description'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['rm_reorder_level'] . " Kg(s)</td>");

            if ($rec['rm_status'] == 1) {
                echo ("<td style='text-align:center'><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td style='text-align:center'><span class='badge badge-pill badge-danger'>Removed</span></td>");
            }
            echo ("<td><button id=" . $rec['rm_id'] . " class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td><button id=" . $rec['rm_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        echo (" No record found");
    }
}

//edit raw material details

function editRawMaterial($id, $name, $desc, $reorder)
{

    $conn = Connection();

    $sql_update = "UPDATE rawmaterial_tbl SET rm_name = '$name', rm_description = '$desc', rm_reorder_level = '$reorder' WHERE rm_id = '$id';";
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

//update the raw material status from 1 to 0

function updateStatus($rmId)
{

    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE rawmaterial_tbl SET rm_status = 0 WHERE rm_id = '$rmId';";

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


function getRM()
{

    $conn = Connection();

    $sqlget = "SELECT * FROM rawmaterial_tbl";

    $sql_result = mysqli_query($conn, $sqlget);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($sql_result);

    if ($nor > 0) {
        while ($rec = mysqli_fetch_assoc($sql_result)) {
            echo ("<option value=" . $rec['rm_id'] . ">" . $rec['rm_name'] . "</option>");
        }
    }
}


//search section for raw material

function rawmatSearch($searchData)
{
    //connection
    $conn = Connection();

    //search SQL 
    $sql_search = "SELECT * 
                        FROM rawmaterial_tbl 
                        WHERE rm_id  LIKE '%$searchData%' OR 
                        rm_name LIKE '%$searchData%' OR 
                        rm_description LIKE '%$searchData%' OR
                        rm_reorder_level LIKE '%$searchData%' OR
                        rm_status LIKE '%$searchData%';";

    $search_result = mysqli_query($conn, $sql_search);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    $nor = mysqli_num_rows($search_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($search_result)) {

            echo ("<div style='display: inline-block; margin: 10px; text-align:center;'>
                            <div class='card' style='width: 100%;'>
                                <div class='card-body'>
                                    <h5 class='card-text' style='color:coral;'>" . $rec["rm_name"] . "</h5>
                                    <hr class='my-4'>
                                    <h6 class='card-text'>Description&nbsp;:&nbsp;" . $rec["rm_description"] . "</h6>
                                    <h6 class='card-text'>Reorder Level&nbsp;:&nbsp;" . $rec["rm_reorder_level"] . "&nbsp;Kg(s)</h6>
                                    <br>
                                    <button style='width:75%; margin-top:5px;' id=" . $rec["rm_id"] . " type='button' class='btn btn-info btn-sm'><i class='fas fa-check fa-1x'></i>&nbsp;Select Part</button>
                                </div>
                            </div>
                        </div>");
        }
    } else {
        echo ("No records found!");
    }
}

function getsingleRawMat($id)
{

    $conn = Connection();

    $sql_select = "SELECT * FROM rawmaterial_tbl WHERE rm_id='$id';";
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
?>