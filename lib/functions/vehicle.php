<?php
//import database connection
include_once('db_conn.php');

//id auto gen
include_once('id_maker.php');


function regEngVehicle($province, $regLetter, $regNumber, $brand, $model, $category, $desc)
{
    //validation
    if (empty($province) or empty($regLetter) or empty($regNumber) or empty($brand) or empty($model) or empty($category)) {
        return ("Please check your inputs ... ");
    }

    //call the connection
    $conn = Connection();

    //call the Auto_id function
    $id = Auto_id("vehicle_id", "vehicle_tbl", "VHL");

    //insert data into vehicle table 

    $sql_insert = "INSERT INTO vehicle_tbl (vehicle_id,v_plate_type,v_plate_identifier,v_province,v_reg_letters,v_reg_number,v_brand,v_model,v_category,v_description,v_status)
                       VALUES ('$id','ENG','-','$province','$regLetter','$regNumber','$brand','$model','$category','$desc',1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return "success";
    } else {
        return "Error, Try again !!";
    }
}

function regDashVehicle($vin, $oldRegNo, $brand, $model, $category, $desc)
{

    //validation
    if (empty($vin) or empty($oldRegNo) or empty($brand) or empty($model) or empty($category)) {
        return ("Please check your inputs ... ");
    }

    //call the connection
    $conn = Connection();

    //call the Auto_id function
    $id = Auto_id("vehicle_id", "vehicle_tbl", "VHL");

    //insert data into vehicle table

    $sql_insert = "INSERT INTO vehicle_tbl (vehicle_id,v_plate_type,v_plate_identifier,v_i_number,v_old_reg_no,v_brand,v_model,v_category,v_description,v_status)
                       VALUES ('$id','Dash','-','$vin','$oldRegNo','$brand','$model','$category','$desc',1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return "success";
    } else {
        return "Error, Try again !!";
    }
}

function regSriVehicle($vin, $oldRegNo, $brand, $model, $category, $desc)
{

    //validation
    if (empty($vin) or empty($oldRegNo) or empty($brand) or empty($model) or empty($category) or empty($desc)) {
        return ("Please check your inputs ... ");
    }

    //call the connection
    $conn = Connection();

    //call the Auto_id function
    $id = Auto_id("vehicle_id", "vehicle_tbl", "VHL");

    //insert data into vehicle table

    $sql_insert = "INSERT INTO vehicle_tbl (vehicle_id,v_plate_type,v_plate_identifier,v_i_number,v_old_reg_no,v_brand,v_model,v_category,v_description,v_status)
                       VALUES ('$id','Sri','ශ්‍රී','$vin','$oldRegNo','$brand','$model','$category','$desc',1);";

    $sql_result = mysqli_query($conn, $sql_insert);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($sql_result > 0) {
        return "success";
    } else {
        return "Error, Try again !!";
    }
}


//view all vehicle details 

function ViewAllVehicles()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM vehicle_tbl WHERE v_status = 1;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['vehicle_id'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['v_province'] . "  " . $rec['v_reg_letters'] . "-" . $rec['v_reg_number'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['v_i_number'] . " " . $rec['v_plate_identifier'] . " " . $rec['v_old_reg_no'] . "</td>");
            echo ("<td>" . $rec['v_brand'] . "</td>");
            echo ("<td>" . $rec['v_model'] . "</td>");
            echo ("<td>" . $rec['v_category'] . "</td>");
            echo ("<td>" . $rec['v_description'] . "</td>");

            if ($rec['v_status'] == 1) {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['vehicle_id'] . " class='btn btn-primary btn-sm'  data-toggle='modal' data-target='#editModal'>Edit</button></td>");
            echo ("<td style='text-align:center;'><button id=" . $rec['vehicle_id'] . " class='btn btn-danger btn-sm'>Delete</button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

function ViewDeletedVehicles()
{

    $conn = Connection();

    $view_sql = "SELECT * FROM vehicle_tbl WHERE v_status = 0;";

    $view_result = mysqli_query($conn, $view_sql);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    //check no of records
    $nor = mysqli_num_rows($view_result);

    if ($nor > 0) {

        while ($rec = mysqli_fetch_assoc($view_result)) {

            echo ("<td>" . $rec['vehicle_id'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['v_province'] . "  " . $rec['v_reg_letters'] . "-" . $rec['v_reg_number'] . "</td>");
            echo ("<td style='text-align:center;'>" . $rec['v_i_number'] . " " . $rec['v_plate_identifier'] . " " . $rec['v_old_reg_no'] . "</td>");
            echo ("<td>" . $rec['v_brand'] . "</td>");
            echo ("<td>" . $rec['v_model'] . "</td>");
            echo ("<td>" . $rec['v_category'] . "</td>");
            echo ("<td>" . $rec['v_description'] . "</td>");

            if ($rec['v_status'] == 1) {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-primary'>Active</span></td>");
            } else {
                echo ("<td style='text-align:center;'><span class='badge badge-pill badge-danger'>Deactive</span></td>");
            }

            echo ("<td style='text-align:center;'><button id=" . $rec['vehicle_id'] . " class='btn btn-secondary btn-reactivate btn-sm'><i class='fas fa-sync'></i>&nbsp;Reactivate</button></td>");
            echo ("</tr>");
        }
    } else {
        return (" No record found");
    }
}

//edit vehicle details

function editVehicle($id, $province, $regletters, $vin, $regno, $brand, $model, $category, $desc)
{

    $conn = Connection();

    if (empty($regletters)) {

        $sql_update = "UPDATE vehicle_tbl 
                        SET v_i_number = '$vin',
                        v_old_reg_no = '$regno',
                        v_brand = '$brand',
                        v_model = '$model',
                        v_category = '$category',
                        v_description = '$desc' 
                        WHERE vehicle_id = '$id';";
    } else {
        $sql_update = "UPDATE vehicle_tbl 
                        SET v_province = '$province',
                        v_reg_letters = '$regletters',
                        v_reg_number = '$regno',
                        v_brand = '$brand',
                        v_model = '$model',
                        v_category = '$category',
                        v_description = '$desc' 
                        WHERE vehicle_id = '$id';";
    }


    $update_result = mysqli_query($conn, $sql_update);

    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("success");
    } else {
        return false;
    }
}

//update the vehicle status from 1 to 0

function delVehicle($vehicleID)
{

    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE vehicle_tbl SET v_status = 0 WHERE vehicle_id = '$vehicleID';";

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

function reactivateVehicle($vehicleID)
{
    //connection
    $conn = Connection();

    //update sql
    $sql_update = "UPDATE vehicle_tbl SET v_status = 1 WHERE vehicle_id = '$vehicleID';";

    $update_result = mysqli_query($conn, $sql_update);

    //validate the command
    if (mysqli_errno($conn)) {
        echo (mysqli_error($conn));
    }

    if ($update_result > 0) {
        return ("reactivated");
    } else {
        return false;
    }
}

function getsingleVehicle($id)
{

    $conn = Connection();

    $sql_select = "SELECT * FROM vehicle_tbl WHERE vehicle_id='$id';";
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